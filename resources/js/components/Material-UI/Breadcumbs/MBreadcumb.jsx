import React, { Component } from 'react';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import Box from '@material-ui/core/Box';
import { NavLink } from 'react-router-dom';
import Icon from '@material-ui/core/Icon';
import Paper from '@material-ui/core/Paper';
import {withStyles} from '@material-ui/core';

const useStyles = theme => ({
    paper:{
        backgroundColor: 'inherit',
        color: 'white',
        marginBottom: '20px',
        display: 'flex',
        justifyContent: 'flex-start',
        alignItems: 'center',
    },
    link :{
        color: '#78909C',
        textDecoration: 'none',
        display: 'flex',
        alignItems: 'center',
        fontSize: '14px',
        '&:hover' : {
            color: '#555555',
        }
    },
    activelink:{
        color: '#555555', fontSize: '14px'
    },
    icon :{
        marginRight: '8px',
        fontSize: '16px',
        textDecoration: 'none',
    }
});


export class MBreadcumb extends Component {
    render() {
        const { classes } = this.props;
        return (
            <Paper elevation={0} className={classes.paper}>
                <Breadcrumbs separator="›" aria-label="breadcrumb">
                    {
                        this.props.items.map((row, i) => {
                            if(row.active === true){
                                return(
                                    <Box key={i} display='flex' alignItems='center' className={classes.activelink}>
                                        <Icon className={classes.icon}>{row.icon}</Icon>
                                        {row.title}
                                    </Box>
                                )
                            }
                            return(
                                <NavLink key={i} color="inherit" to={row.link} className={classes.link}>
                                    <Icon className={classes.icon}>{row.icon}</Icon>
                                    {row.title}
                                </NavLink>
                            )
                        })
                    }
                    
                </Breadcrumbs>
            </Paper>
        );
    }
}

export default withStyles(useStyles)(MBreadcumb);
