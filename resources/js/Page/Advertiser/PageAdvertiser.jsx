import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import CustomTable from '../../components/Material-UI/Table/CustomTable';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import KelolaAction from '../../components/Material-UI/Dialog/KelolaAction';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';

import { Redirect } from 'react-router'
import { columns } from './Properties/Properties';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchAdvertiser, deleteAdvertiser} from '../../Actions/AdvertiserActions';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched, onSubmit, onNotify } from '../../Actions/pageActions';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Advertiser', icon: 'face', active: true},
];

export class PageAdvertiser extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            redirect : false,
        }
    }

    handleSearch = async (key) => {
        await this.props.prepareSearch()
        await this.props.fetchAdvertiser(key)
        await this.props.onSearched()
    }

    handleDelete = async (id) => {
        this.props.onSubmit(true, 'Coba Loading')
        await this.props.deleteAdvertiser(id)
        await this.props.fetchAdvertiser('')
        this.props.onNotify(true, 'error', 'Berhasil Text')
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
        await this.props.fetchAdvertiser('')
        columns.push(aksi)
        await this.props.onMounted('Advertiser')
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

        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataAdvertiser} = this.props.advertiser;

        if(this.state.redirect === true) {
            return <Redirect push to='/dashboard/perlengkapan/advertiser/add' />
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
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Daftar Advertiser </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <CustomTable 
                                    title='Tabel Daftar Advertiser' 
                                    onSearch={ (value) => {this.handleSearch(value)}} 
                                    columns={columns}
                                    data={dataAdvertiser}
                                    loading={dataLoading}
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
        advertiser: state.AdvertiserReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchAdvertiser: bindActionCreators(fetchAdvertiser, dispatch),
        deleteAdvertiser: bindActionCreators(deleteAdvertiser, dispatch),
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
    }
} 

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageAdvertiser);
