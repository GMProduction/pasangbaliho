import React, { Component } from 'react';

import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';

import Box from '@material-ui/core/Box';
import {BasicPanel, BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Button from '@material-ui/core/Button';
import CustomTable from '../../components/Material-UI/Table/CustomTable';

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

    
    async componentDidMount(){
        
        const aksi = {
            title: 'Aksi',
            cellStyle: 
            {
                textAlign: 'center', 
                fontSize: 12
            },
        headerStyle:{textAlign: 'center', minWidth: '120px'},
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
                            <CustomTable 
                                title='Daftar Pembayaran Masuk Via Transfer Manual' 
                                onSearch={ (value) => {this.handleSearch(value)}} 
                                columns={columnsPayment}
                                data={dataPayment}
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
