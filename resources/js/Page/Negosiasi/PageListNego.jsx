import React, { Component } from 'react';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import BCPageListNego from '../../components/Material-UI/Breadcumbs/BCPageListNego';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
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
    {title: 'Negosiasi', icon: 'question_answer', link:'/dashboard/negosiasi', active: false},
    {title: 'Daftar Negosiasi', icon: 'list',  active: true},
];

export class PageListNego extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
        }
    }

    handleSearch = async (key) => {
        let filter = this.props.filter;
        await this.props.prepareSearch()
        await this.props.fetchNegosiasi(filter, key)
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

    async componentDidMount () {
        let filter = this.props.filter;
        const aksi = {title: 'Aksi',headerStyle:{textAlign: 'center',width: '15%'},cellStyle:{textAlign: 'center',width: '15%'},sorting: false,
                render: rowData => 
                <div>
                    <Button variant="outlined" size='small' color="primary" 
                        component={NavLink} 
                        to={`/dashboard/negosiasi/${filter}/${rowData.id_transaksi}`}
                    >
                        Kelola
                    </Button>
                </div>
            }
        columns.push(aksi)
        await this.props.prepareMount()
        await this.props.fetchNegosiasi(filter, '')
        await this.props.onMounted('Negosiasi')
    }

    componentWillUnmount () {
        columns.pop()
    }
    
    render() {
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataNegosiasi} = this.props.negosiasi;
        const {filter} = this.props;
        let title = 'Semua Proses Negosiasi';
        switch (filter) {
            case 'permintaan':
                title = 'Permintaan Harga Advertiser'
                break;
            case 'negoharga':
                title = 'Negosiasi Harga'
                break;
            case 'negomateri':
                title = 'Negosiasi Materi'
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
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Fade bottom>
                <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>
                                Daftar {title}
                            </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center' style={{paddingLeft: '20px'}}>
                                <Box display='flex' flexGrow={1} fontSize={18} fontFamily='Roboto'>Daftar {title}</Box>
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
                            <BasicTable columns={columns} data={dataNegosiasi} loading={dataLoading}/>
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
        fetchNegosiasi: bindActionCreators(fetchNegosiasi, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageListNego);
