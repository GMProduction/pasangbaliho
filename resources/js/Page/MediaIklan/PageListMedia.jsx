import React, { Component } from 'react';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import { NavLink } from 'react-router-dom';
import Icon from '@material-ui/core/Icon';
import Paper from '@material-ui/core/Paper';
import Box from '@material-ui/core/Box';
import {withStyles} from '@material-ui/core';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
import TextField from '@material-ui/core/TextField';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { breadcumbStyle } from '../../Style/Breadcumb'
import { columnsPermintaan } from './Properties/Properties';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {fetchMedia, searchMedia, onUnMount} from '../../Actions/MediaIklanActions';

export class PageListMedia extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchKey: '',
        }
    }

    handleSearch = async (e) => {
        this.props.searchMedia(this.props.match.params.filter, e.target.value)
    }
    onSearch = async (e) => {
        if (e.keyCode === 13) {
            this.handleSearch(e);
        }    
    }

    handleChange = async (e) => {
        let v = e.target.value;
        if (v === '') {
            this.handleSearch(e);
        }
        this.setState({
            searchKey: e.target.value
        })
    }

    componentDidMount () {
        this.props.fetchMedia(this.props.match.params.filter, '')
    }

    componentWillUnmount () {
        this.props.onUnMount();
    }

    render() {
        const { classes } = this.props;
        console.log(this.props.match.params.filter);
        
        return (
            <div>
                <LoadingBar
                    progress={this.props.reducer.loadingBarProgress}
                    height={3}
                    color='#f11946'
                   />
                <Paper elevation={0} style={breadcumbStyle.paper}>
                    <Breadcrumbs separator="›" aria-label="breadcrumb">
                            <NavLink
                            color="inherit" to="/admin"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>dashboard</Icon>
                                Dashboard
                            </NavLink>
                            <NavLink
                            color="inherit" to="/admin/mediaiklan"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>desktop_mac</Icon>
                                Media Iklan
                            </NavLink>
                        <Box display='flex' alignItems='center' style={{color: '#555555', fontFamily: 'Roboto', fontSize: '14px'}}>
                            <Icon className={classes.icon}>list</Icon>
                                Semua Media Iklan
                            </Box>
                    </Breadcrumbs>
                </Paper>
                {
                    !this.props.reducer.pageLoading ?
                
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Daftar Harga Media Terpublikasi</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center'>
                                <Box display='flex' flexGrow={1} fontSize={18} fontFamily='Roboto'>Tabel Permintaan</Box>
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
                            <BasicTable
                                columns={columnsPermintaan}
                                data={this.props.reducer.data}
                                loading={this.props.reducer.dataLoading}
                            />
                        </BasicPanelContent>
                    </BasicPanel>
                </Fade>
                :
                <Preloading textloading={this.props.reducer.loadingStatus}/>
            }
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        reducer: state.MediaIklanReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchMedia: bindActionCreators(fetchMedia, dispatch),
        searchMedia: bindActionCreators(searchMedia, dispatch),
        onUnMount: bindActionCreators(onUnMount, dispatch),
    }
}

export default compose(
    withStyles(breadcumbStyle),
    connect(mapStateToProps, mapDispatcToProps)    
    )(PageListMedia);
