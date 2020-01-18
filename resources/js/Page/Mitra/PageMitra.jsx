import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import CustomTable from '../../components/Material-UI/Table/CustomTable';
import ToggleButton from '@material-ui/lab/ToggleButton';
import ToggleButtonGroup from '@material-ui/lab/ToggleButtonGroup';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import ConfirmAksi from '../../components/Material-UI/Dialog/ConfirmAksi';
import KelolaAction from '../../components/Material-UI/Dialog/KelolaAction';
import LoadingScreen from '../../components/Material-UI/Dialog/LoadingScreen';
import {withStyles} from '@material-ui/core';

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


const useStyles = theme => ({
    indicator: {
        backgroundColor: 'inherit',
        color: 'inherits'
    },
    label:{
        textTransform: 'capitalize',
        color: 'white'
    },
    root:{
        borderWidth: '0px',
        marginLeft: '10px'

    },
});

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', active: true},
];


export class PageMitra extends Component {

    constructor(props) {
        super(props);
        this.state = {
            buttonOn: 0,
            redirect : false,
            notif: false,
            submitProses: false, error: false, succes: false,
            tab: 0
        }
    }

    handleSearch = async (key) => {
        await this.props.prepareSearch()
        await this.props.fetchMitra(key)
        await this.props.onSearched()
    }
    
    handleDelete = async (id) => {
        alert(id)
        // this.setState({submitProses: true,})
        // let res = await this.props.deleteMitra(a)
        // if (res.status !== 'success'){
        //     this.setState({error: true,success: false})
        // }else{
        //     this.setState({error: false,success: true})
        // }
        // await this.props.fetchMitra('')
        // this.setState({submitProses: false,})
    }

   async componentDidMount () {
        const aksi = {title: 'Kelola',headerStyle:{textAlign: 'center',minWidth: '100px'},cellStyle:{textAlign: 'center',fontSize: 12},
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

    handleChangeToggle = (e, value) => {
        this.setState({buttonOn: value})
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
                            <Box>
                            <ToggleButtonGroup
                                value={this.state.buttonOn}
                                exclusive
                                onChange={this.handleChangeToggle}
                                className={classes.indicator}
                                aria-label="text alignment"
                                size='small'
                                classes={{
                                    root: classes.root
                                }}
                            >
                                <ToggleButton classes={{
                                    root: classes.root,
                                    label: classes.label,
                                }} value={0} aria-label="left aligned">
                                Daftar Mitra
                                </ToggleButton>
                                <ToggleButton classes={{
                                    root: classes.root,
                                    label: classes.label,
                                }} value={1} aria-label="centered">
                                permintan Mitra
                                </ToggleButton>
                                
                            </ToggleButtonGroup>
                            </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <CustomTable 
                                title='Coba' 
                                onSearch={ (value) => {this.handleSearch(value)}} 
                                columns={columns}
                                data={dataMitra}
                                loading={dataLoading}
                                />
                        </BasicPanelContent>
                    </BasicPanel>
                    </Fade>
                <LoadingScreen open={this.state.submitProses} text='Sedang Loading'/>
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
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps)
    )(PageMitra);
