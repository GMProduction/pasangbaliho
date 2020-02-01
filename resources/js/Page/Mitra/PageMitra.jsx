import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import CustomTable from '../../components/Material-UI/Table/CustomTable';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import KelolaAction from '../../components/Material-UI/Dialog/KelolaAction';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { columns } from './Properties/Properties';
import { Redirect } from 'react-router'
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchMitra, deleteMitra} from '../../Actions/MitraActions';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched, onSubmit, onNotify} from '../../Actions/pageActions';



const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', active: true},
];


export class PageMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            redirect : false,
        }
    }

    handleSearch = async (key) => {
        await this.props.prepareSearch()
        await this.props.fetchMitra(key)
        await this.props.onSearched()
    }
    
    handleDelete = async (id) => {
        this.props.onSubmit(true, 'Sedang Menghapus Data...')
        let res = await this.props.deleteMitra(id)
        if (res.status === 'success'){
            await this.props.fetchMitra('')
            this.props.onNotify(true, 'success', 'Berhasil Menghapus Data Mitra')
        }else{
            this.props.onNotify(true, 'error', 'Gagal Menghapus Data Mitra')
        }
        this.props.onSubmit(false, '')
    }

   async componentDidMount () {
        const aksi = {title: 'Kelola',headerStyle:{textAlign: 'center',minWidth: '120px'},cellStyle:{textAlign: 'center',fontSize: 12},
            sorting: false,
            render: rowData => 
                        <KelolaAction 
                        editUrl={`/dashboard/perlengkapan/mitra/edit/${rowData.id_client}`}
                        id={rowData.id_client}
                        message={`Apakah Anda Yakin Ingin Menghapus Mitra ${rowData.nama}`}
                        onDelete={this.handleDelete}/>
        }
        
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.fetchMitra('') 
        columns.push(aksi)
        await this.props.onMounted('Mitra')
    }

    handleClick = () => {
        this.setState({
            redirect: true
        })
    }

    componentWillUnmount () {
        columns.pop()
    }

    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataMitra} = this.props.mitra;

        if(this.state.redirect === true) {
            return <Redirect push to='/dashboard/perlengkapan/mitra/add' />
        }

        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }
        return (
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946'/>
                    <MBreadcumb items={breadcumbItems}/>
                        <Fade right>
                        <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>DAFTAR MITRA IKLAN</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                                <CustomTable 
                                title='Tabel Daftar Mitra Iklan' 
                                onSearch={ (value) => {this.handleSearch(value)}} 
                                columns={columns}
                                data={dataMitra}
                                loading={dataLoading}
                                button={['add']}
                                onAddClicked={this.handleClick}
                                />
                        </BasicPanelContent>
                    </BasicPanel>
                    </Fade>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        mitra: state.MitraReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchMitra: bindActionCreators(fetchMitra, dispatch),
        deleteMitra: bindActionCreators(deleteMitra, dispatch),
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageMitra);
