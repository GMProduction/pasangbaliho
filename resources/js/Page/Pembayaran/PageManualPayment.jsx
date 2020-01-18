import React, { Component } from 'react';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';

import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';

import { NavLink } from 'react-router-dom';
import { columnsPayment } from './Properties/Properties';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched } from '../../Actions/pageActions';
import {fetchPayment} from '../../Actions/PaymentActions';

export class PageManualPayment extends Component {

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
        await this.props.fetchPayment('pending', key, 'Manual Payment')
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
    
    async componentDidMount(){
        
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
                        <div>
                            <Button variant="outlined" size='small' color="primary" 
                                component={NavLink} 
                                to={`/dashboard/pembayaran/manual/${rowData.id}`}
                            >
                                Kelola
                            </Button>
                        </div>
        }
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.fetchPayment('pending', '', 'Manual Payment')
        columnsPayment.push(aksi)
        await this.props.onMounted('Pembayaran')
    }

    componentWillUnmount () {
        columnsPayment.pop()
    }
    render(){
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataPayment} = this.props.payment;
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
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Daftar Pembayaran Manual Transfer</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center' style={{paddingLeft: '20px'}}>
                                <Box display='flex' flexGrow={1} fontSize={18} fontFamily='Roboto'>Daftar Pembayaran Manual Transfer</Box>
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
                            <BasicTable columns={columnsPayment} data={dataPayment} loading={dataLoading}/>
                        </BasicPanelContent>
                    </BasicPanel>
                </Fade>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        page: state.PageReducer,
        payment: state.PaymentReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        fetchPayment: bindActionCreators(fetchPayment, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
    }
}
export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageManualPayment);
