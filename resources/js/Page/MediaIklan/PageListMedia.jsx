import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';
import Button from '@material-ui/core/Button';
import Box from '@material-ui/core/Box';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
import TextField from '@material-ui/core/TextField';
import BCPageListMedia from '../../components/Material-UI/Breadcumbs/BCPageListMedia';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { columns } from './Properties/Properties';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {prepareMount, onMounted, prepareSearch, onSearched, fetchMedia} from '../../Actions/MediaIklanActions';


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
        let link = 'detail'
        if (this.props.filter === 'pending') {
            link = 'permintaan'
        }
        const aksi = {title: 'Aksi',headerStyle:{textAlign: 'center',width: '15%'},cellStyle:{textAlign: 'center',width: '15%'},sorting: false,
                render: rowData => 
                <div>
                    <Button variant="outlined" size='small' color="primary" 
                        component={NavLink} 
                        to={`/mediaiklan/${link}/${rowData.id_baliho}`}
                    >
                        Kelola
                    </Button>
                </div>
            }
        columns.push(aksi)
        let filter = this.props.filter;
        await this.props.prepareMount()
        await this.props.fetchMedia(filter, '')
        await this.props.onMounted()
    }

    componentWillUnmount () {
        columns.pop()
    }

    render() {

        const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
        const {dataMedia} = this.props.mediaiklan;
        const {filter} = this.props;
        let title = 'Semua Media Iklan';

        switch (filter) {
            case 'pending':
                title = 'Permintaan Penambahan Media Iklan'
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
                <BCPageListMedia/>
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
                            <BasicTable columns={columns} data={dataMedia} loading={dataLoading}/>
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
        prepareMount: bindActionCreators(prepareMount, dispatch),
        fetchMedia: bindActionCreators(fetchMedia, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        prepareSearch: bindActionCreators(prepareSearch, dispatch),
        onSearched: bindActionCreators(onSearched, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps) 
    )(PageListMedia);
