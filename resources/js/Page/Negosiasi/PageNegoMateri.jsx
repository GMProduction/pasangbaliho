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
import { loadNegosiasiMateri } from '../../Controller/NegosiasiControll';
import { breadcumbStyle } from '../../Style/Breadcumb'
import { columnsPermintaanNegoMateri } from './Properties/Properties';

export class PageNegoMateri extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
            isLoading: true,
            data: [],
            key: '',
            dataLoading: true
        }
    }

    initData = async () => {
        this.setState({
            loadingBarProgress: 50,
        })
        let negoharga = await loadNegosiasiMateri();
        this.setState({
            data : negoharga,
            dataLoading: false,
            loadingBarProgress: 100,
            isLoading: false
        })
    }

    componentDidMount () {
        this.initData()
    }

    render() {
        const { classes } = this.props;
        return (
            <div>
                <LoadingBar
                    progress={this.state.loadingBarProgress}
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
                            color="inherit" to="/admin/negosiasi"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>question_answer</Icon>
                                Negosiasi
                            </NavLink>
                        <Box display='flex' alignItems='center' style={{color: '#555555', fontFamily: 'Roboto Light', fontSize: '14px'}}>
                            <Icon className={classes.icon}>announcement</Icon>
                                Negosiasi Materi
                            </Box>
                    </Breadcrumbs>
                </Paper>
                <Fade bottom>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1}>Permintaan Negosiasi Materi </Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                            <Box display='flex' alignItems='center'>
                                <Box display='flex' flexGrow={1} fontSize={18} fontFamily='Roboto Regular'>Tabel Permintaan</Box>
                                <Box>
                                    <TextField
                                        id="outlined-basic"
                                        label="Cari"
                                        margin="dense"
                                        variant="outlined"
                                        value={this.state.key}
                                        onChange={this.handleChange}
                                        onKeyUp={this.search}
                                    />
                                </Box>
                            </Box>
                            <BasicTable
                                columns={columnsPermintaanNegoMateri}
                                data={this.state.data}
                                loading={this.state.dataLoading}
                            />
                        </BasicPanelContent>
                    </BasicPanel>
                </Fade>
            </div>
        );
    }
}

export default withStyles(breadcumbStyle)(PageNegoMateri);
