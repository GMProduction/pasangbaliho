import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import Box from '@material-ui/core/Box';

import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import CustomTable from '../../components/Material-UI/Table/CustomTable';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import KelolaAction from '../../components/Material-UI/Dialog/KelolaAction';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { columns } from './Properties/Properties';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {fetchMedia, deleteMedia} from '../../Actions/MediaIklanActions';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched, onSubmit, onNotify } from '../../Actions/pageActions';

import {withStyles} from '@material-ui/core';



const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', link: '/dashboard/mediaiklan', active: false},
    {title: 'Daftar Media Iklan', icon: 'list', active: true},
];

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});

export class PageListMedia extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
        }
    }

    handleSearch = async (key) => {
        let filter = this.props.filter;
        await this.props.prepareSearch()
        await this.props.fetchMedia(filter, key)
        await this.props.onSearched()
    }


    handlePublish = async (a) => {
        let filter = this.props.filter;
        this.setState({submitProses: true,})
        let data = new FormData()
        data.append('idBaliho', a)
        data.append('status', 'publish')
        let res = await this.props.ChangeStatusMedia(data)
        await this.props.fetchMedia(filter, '')
        this.setState({submitProses: false})
        if(res.status === 'success'){
            this.setState({error: false,success: true})
        }else{
            this.setState({error: true,success: false})
        }
        
    }
    handleBlock = async (a) => {
        let filter = this.props.filter;
        this.setState({submitProses: true,})
        let data = new FormData()
        data.append('idBaliho', a)
        data.append('status', 'block')
        let res = await this.props.ChangeStatusMedia(data)
        await this.props.fetchMedia(filter, '')
        this.setState({submitProses: false})
        if(res.status === 'success'){
            this.setState({error: false,success: true})
        }else{
            this.setState({error: true,success: false})
        }
        
    }

    handleDelete = async (a) => {
        let filter = this.props.filter;
        this.setState({submitProses: true,})
        let res = await this.props.deleteMedia(a)
        await this.props.fetchMedia(filter, '')
        this.setState({submitProses: false})
        if(res.status === 'success'){
            this.setState({error: false,success: true})
        }else{
            this.setState({error: true,success: false})
        }
    }

    async componentDidMount () {
        let link = 'detail'
        if (this.props.filter === 'pending') {
            link = 'permintaan'
        }
        const aksi = {title: 'Aksi',headerStyle:{textAlign: 'center',minWidth: '150px'},cellStyle:{textAlign: 'center'},sorting: false,
                render: rowData => 
                <div>
                    {
                        this.props.filter !== 'pending' ?
                        
                        <Box display='flex' justifyContent='coenter'>
                            <KelolaAction 
                                editUrl={`/dashboard/mediaiklan/detail/${rowData.id_baliho}`}
                                id={rowData.id_baliho}
                                message={`Apakah Anda Yakin Ingin Menghapus Baliho ${rowData.nama_baliho}`}
                                onDelete={this.handleDelete}/>
                        </Box>
                        
                        :
                        
                        <Button variant="outlined" size='small' color="primary" 
                            component={NavLink} 
                            to={`/dashboard/mediaiklan/${link}/${rowData.id_baliho}`}
                        >
                            Kelola
                        </Button>
                    }
                    
                </div>
            }
        columns.push(aksi)
        let filter = this.props.filter;
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.fetchMedia(filter, '')
        await this.props.onMounted('Media Iklan')
    }

    componentWillUnmount () {
        columns.pop()
    }

    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataMedia} = this.props.mediaiklan;
        const {filter} = this.props;
        let title = 'Semua Media Iklan';
        switch (filter) {
            case 'pending':
                title = 'Tabel Daftar Permintaan Penambahan Media Iklan'
                break;
            case 'publish':
                title = 'Media Iklan Terpublikasi'
                break;
            case 'block':
                title = 'Media Iklan Terblokir'
                break;
            default:
                break;
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
                <MBreadcumb items= {breadcumbItems}/>
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Daftar {title}</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <CustomTable 
                                title={title}
                                onSearch={ (value) => {this.handleSearch(value)}} 
                                columns={columns}
                                data={dataMedia}
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
        mediaiklan: state.MediaIklanReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchMedia: bindActionCreators(fetchMedia, dispatch),
        deleteMedia: bindActionCreators(deleteMedia, dispatch),
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
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageListMedia);
