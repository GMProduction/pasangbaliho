import React, {Component} from 'react'
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import CustomTable from '../../components/Material-UI/Table/CustomTable';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import { columns } from './Properties/Properties';
import {fetchNegosiasi} from '../../Actions/NegosiasiActions'; 
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched} from '../../Actions/pageActions';
import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';

const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Pembayaran', icon: 'payment', link:'/dashboard/pembayaran', active: false},
    {title: 'Daftar Proses Pembayaran', icon: 'list',  active: true},
];

export class PageListPembayaran extends Component{

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
        }
    }

    handleSearch = async (key) => {
        await this.props.prepareSearch()
        await this.props.fetchNegosiasi('pembayaran', key)
        await this.props.onSearched()
    }


    async componentDidMount () {
        const aksi = {title: 'Aksi',headerStyle:{textAlign: 'center',width: '15%'},cellStyle:{textAlign: 'center',width: '15%'},sorting: false,
                render: rowData => 
                <div>
                    <Button variant="outlined" size='small' color="primary" 
                        component={NavLink} 
                        to={`/dashboard/pembayaran/list/${rowData.id_transaksi}`}
                    >
                        Kelola
                    </Button>
                </div>
            }
        columns.push(aksi)
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.fetchNegosiasi('pembayaran', '')
        await this.props.onMounted('Pembayaran')
    }

    componentWillUnmount () {
        columns.pop()
    }

    render(){
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataNegosiasi} = this.props.negosiasi;
        const {filter} = this.props;
        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }
        return(
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Fade bottom>
                <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>
                                Daftar Proses Pembayaran
                            </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <CustomTable 
                                title='Daftar Proses Pembayaran' 
                                onSearch={ (value) => {this.handleSearch(value)}} 
                                columns={columns}
                                data={dataNegosiasi}
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
        negosiasi: state.NegosiasiReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
        fetchNegosiasi: bindActionCreators(fetchNegosiasi, dispatch),
    }
}
export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageListPembayaran);