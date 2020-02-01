import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import CustomTable from '../../components/Material-UI/Table/CustomTable';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { columns } from './Properties/Properties';
import { Redirect } from 'react-router'
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchRequestMitra, deleteMitra} from '../../Actions/MitraActions';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched, onSubmit, onNotify} from '../../Actions/pageActions';



const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', active: true},
];


export class PageRequestMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            redirect : false,
        }
    }

    handleSearch = async (key) => {
        await this.props.prepareSearch()
        await this.props.fetchRequestMitra(key)
        await this.props.onSearched()
    }
    

   async componentDidMount () {
        const aksi = {title: 'Kelola',headerStyle:{textAlign: 'center',minWidth: '120px'},cellStyle:{textAlign: 'center',fontSize: 12},
            sorting: false,
            render: rowData => 
                    <Button variant="outlined" size='small' color="primary" 
                        component={NavLink} 
                        to={`/dashboard/perlengkapan/requestmitra/${rowData.id_client}`}
                    >
                        Kelola
                    </Button>
        }
        
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.fetchRequestMitra('') 
        columns.push(aksi)
        await this.props.onMounted('Mitra')
    }


    componentWillUnmount () {
        columns.pop()
    }

    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataMitra} = this.props.mitra;

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
                            <Box flexGrow={1}>DAFTAR PERMINTAAN MENJADI MITRA MEDIA</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                                <CustomTable 
                                title='Tabel Daftar Permintaan Menjadi Mitra Media' 
                                onSearch={ (value) => {this.handleSearch(value)}} 
                                columns={columns}
                                data={dataMitra}
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
        mitra: state.MitraReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchRequestMitra: bindActionCreators(fetchRequestMitra, dispatch),
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
    )(PageRequestMitra);
