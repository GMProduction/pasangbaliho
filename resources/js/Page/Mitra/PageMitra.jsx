import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';


import BCPageMitra from '../../components/Material-UI/Breadcumbs/BCPageMitra';
import ConfirmAksi from '../../components/Material-UI/Dialog/ConfirmAksi';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { columns } from './Properties/Properties';
import { Redirect } from 'react-router'
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchMitra, deleteMitra} from '../../Actions/MitraActions';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched } from '../../Actions/pageActions';



export class PageMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            redirect : false,
            notif: false
        }
    }

    

    handleSearch = async (key) => {
        await this.props.prepareSearch()
        await this.props.fetchMitra(key)
        await this.props.onSearched()
    }
    
    onSearch = async (e) => {
        let key = e.target.value;
        if (e.keyCode === 13) {
            this.handleSearch(key);
        }        
    }

    handleChange = async (e) => {
        let v = e.target.value;
        if (v === '') {
            this.handleSearch(v);
        }
        this.setState({
            searchKey: e.target.value
        })
    }

    handleDelete = async (a) => {
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Penghapusan Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Penghapusan Data...')
        await this.props.deleteMitra(a)
        await this.props.fetchMitra('')
        await this.props.onMounted('Mitra')
    }

   async componentDidMount () {

        const aksi = {
            title: 'Aksi',
            headerStyle:
                {
                    textAlign: 'center', 
                    width: '15%'
                },
            cellStyle:
                {
                    textAlign: 'center',
                },
            sorting: false,
            render: rowData => 
                        <ConfirmAksi 
                        url={`/mitra/edit/${rowData.id_client}`}
                        id={rowData.id_client}
                        dialogTitle={`Apakah Anda Yakin Ingin Menghapus Mitra ${rowData.nama}`}
                        onSubmit={this.handleDelete}/>
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
        
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataMitra} = this.props.mitra;

        if(this.state.redirect === true) {
            return <Redirect push to='/mitra/add' />
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
                <BCPageMitra/>
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Daftar Mitra</Box>
                            <Box><Button onClick={this.handleClick}>Tambah Daftar Mitra</Button></Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center' style={{paddingLeft: '20px'}}>
                                <Box display='flex' flexGrow={1} fontSize={18} fontFamily='Roboto'>Daftar Mitra</Box>
                                <Box>
                                    <TextField
                                        id="outlined-basic"
                                        label="Cari"
                                        margin="dense"
                                        variant="outlined"
                                        value={this.state.searchKey}
                                        onChange={this.handleChange}
                                        onKeyUp={this.onSearch}
                                    />
                                </Box>
                            </Box>
                            <BasicTable columns={columns} data={dataMitra} loading={dataLoading}/>
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
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageMitra);
