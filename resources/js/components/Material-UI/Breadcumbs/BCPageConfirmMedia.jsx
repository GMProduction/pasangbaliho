import React, { Component } from 'react';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import Box from '@material-ui/core/Box';
import { NavLink } from 'react-router-dom';
import Icon from '@material-ui/core/Icon';
import Paper from '@material-ui/core/Paper';
import {withStyles} from '@material-ui/core';
import { breadcumbStyle } from '../../../Style/Breadcumb';


export class BCPageConfirmMedia extends Component {
    render() {
        return (
            <Paper elevation={0} style={breadcumbStyle.paper}>
                <Breadcrumbs separator="›" aria-label="breadcrumb">
                        <NavLink
                        color="inherit" to="/"
                        className={classes.link}
                        >
                        <Icon className={classes.icon}>dashboard</Icon>
                            Dashboard
                        </NavLink>
                        <NavLink
                        color="inherit" to="/mediaiklan"
                        className={classes.link}
                        >
                        <Icon className={classes.icon}>desktop_mac</Icon>
                            Media Iklan
                        </NavLink>
                        <NavLink
                        color="inherit" to="/mediaiklan/permintaan"
                        className={classes.link}
                        >
                        <Icon className={classes.icon}>local_offer</Icon>
                            Permintaan
                        </NavLink>
                    <Box display='flex' alignItems='center' className={classes.activelink}>
                        <Icon className={classes.icon}>check_box</Icon>
                            Konfirmasi Media
                        </Box>
                </Breadcrumbs>
            </Paper>
        );
    }
}

export default withStyles(breadcumbStyle)(BCPageConfirmMedia);
