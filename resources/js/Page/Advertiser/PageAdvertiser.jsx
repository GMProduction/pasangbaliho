import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';

import BCPageAdvertiser from '../../components/Material-UI/Breadcumbs/BCPageAdvertiser';
import ConfirmAksi from '../../components/Material-UI/Dialog/ConfirmAksi';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';

import { Redirect } from 'react-router'
import { columns } from './Properties/Properties';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchAdvertiser, deleteAdvertiser} from '../../Actions/AdvertiserActions';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched } from '../../Actions/pageActions';

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
        await this.props.deleteAdvertiser(a)
        await this.props.fetchAdvertiser('')
        await this.props.onMounted('Advertiser')
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
                        url={`/dashboard/perlengkapan/advertiser/edit/${rowData.id}`}
                        id={rowData.id}
                        dialogTitle={`Apakah Anda Yakin Ingin Menghapus Advertiser ${rowData.nama}`}
                        onSubmit={this.handleDelete}/>
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
                <BCPageAdvertiser/>
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Daftar Advertiser </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center' style={{paddingLeft: '20px'}}>
                            <Box display='flex' flexGrow={1}>
                                    <Button variant='contained' color='primary' onClick={this.handleClick}>Tambah</Button>
                                </Box>
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
                            <BasicTable columns={columns} data={dataAdvertiser} loading={dataLoading}/>
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
    }
} 

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageAdvertiser);
