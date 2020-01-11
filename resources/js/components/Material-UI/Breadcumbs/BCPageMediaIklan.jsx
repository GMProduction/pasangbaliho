import React, { Component } from 'react';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import Box from '@material-ui/core/Box';
import { NavLink } from 'react-router-dom';
import Icon from '@material-ui/core/Icon';
import Paper from '@material-ui/core/Paper';
import {withStyles} from '@material-ui/core';
import { breadcumbStyle } from '../../../Style/Breadcumb';

export class BCPageMediaIklan extends Component {

    render() {
        const { classes } = this.props;
        return (
            <Paper elevation={0} style={breadcumbStyle.paper}>
                <Breadcrumbs separator="›" aria-label="breadcrumb">
                        <NavLink
                        color="inherit" to="/dashboard"
                        className={classes.link}
                        >
                        <Icon className={classes.icon}>dashboard</Icon>
                            Dashboard
                        </NavLink>
                        <Box display='flex' alignItems='center' className={classes.activelink}>
                        <Icon className={classes.icon}>desktop_mac</Icon>
                            Media Iklan
                        </Box>
                </Breadcrumbs>
            </Paper>
        );
    }
}

export default withStyles(breadcumbStyle)(BCPageMediaIklan);
