import React, {Component} from 'react'

import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import FormControl from '@material-ui/core/FormControl';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import Select from '@material-ui/core/Select';
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

const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    }
}
export class PageLaporanTransaksi extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
            status: ''
        }
    }

    handleSearch = async () => {
        await this.props.prepareSearch()
        await this.props.fetchNegosiasi(this.state.status, this.state.searchKey)
        await this.props.onSearched()
    }

    onSearch = async (e) => {
        let key = e.target.value;
        if (e.keyCode === 13) {
            this.handleSearch();
        }        
    }

    handleChange = async (e) => {
        let v = e.target.value;
        let name = e.target.name;
        if ((v === '') || (name === 'status')) {
            this.handleSearch();
        }

        this.setState({
            [e.target.name]: e.target.value
        })
    }

    async componentDidMount () {
        await this.props.prepareMount()
        await this.props.fetchNegosiasi('all', '')
        await this.props.onMounted('Negosiasi')
    }

    
    render(){
        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataNegosiasi} = this.props.negosiasi;

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
                                Daftar Proses Transaksis
                            </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center' style={{paddingLeft: '20px'}}>
                                <Box display='flex' flexGrow={1} fontSize={18} fontFamily='Roboto'>Daftar Transaksi</Box>
                                <Box>
                                <FormControl variant='outlined' margin='dense' fullWidth>
                                    <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                        Proses
                                    </InputLabel>
                                    <Select
                                        id="demo-simple-select-outlined"
                                        value={this.state.status}
                                        onChange={this.handleChange}
                                        labelWidth={80}
                                        style={style.resize}
                                        name='status'
                                        >
                                            <MenuItem value='all' style={style.resize}>Semua</MenuItem>
                                            <MenuItem value='permintaan' style={style.resize}>Permintaan</MenuItem>
                                            <MenuItem value='negoharga' style={style.resize}>Negosiasi Harga</MenuItem>
                                            <MenuItem value='pembayaran' style={style.resize}>Pembayaran</MenuItem>
                                            <MenuItem value='negomateri' style={style.resize}>Negosiasi Materi</MenuItem>
                                            <MenuItem value='selesai' style={style.resize}>Selesai</MenuItem>
                                    </Select>
                                </FormControl>
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
                                        name='searchKey'
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
    )(PageLaporanTransaksi);