import React, { Component } from 'react';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import Divider from '@material-ui/core/Divider';
import Icon from '@material-ui/core/Icon';
import {withStyles} from '@material-ui/core';
import { NavLink } from 'react-router-dom';
import Box from '@material-ui/core/Box';

const useStyles = theme => ({
    toolbar: theme.mixins.toolbar,
    divider:{
        marginBottom: '15px'
    },
    item: {
        background: 'inherit',
        margin: '0px 15px 10px 15px',
        borderRadius: '5px',
        width: '220px',
        height: '50px',
        paddingRight: '1px'
    },
    collapseIcon: {
        backgroundColor: 'red'
    },
    subItemIcon: {
        marginLeft: '25px',
        marginRight: '15px'
    },
    '@global':{
        '.mainWrap':{
            fontFamily: 'Roboto'
        },
        '.mysidenav':{
            color: '#34352F'
        },
        '.mysidenav li .active':{
            borderRadius: '5px',
            backgroundColor: '#9129AC',
            boxShadow: '0px 0px 8px #D3C2DA',
            color: 'white'
        },
        '.mysidenav li .material-icons':{
            marginRight: '15px'
        },
    }
    
});


export class Sidebar extends Component {

    constructor(props) {
        super(props);
    }

    
    render() {
        const { classes } = this.props;
        
        return (
            <div className='mysidenav'>
                <Box className={classes.toolbar} fontSize={20} fontFamily='Roboto Regular' display='flex' alignItems='center' justifyContent='center'>
                    PASANG BALIHO
                </Box>
                <Divider variant='middle' classes={{
                    root: classes.divider
                }}/>
                <List>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin' exact
                        >
                            <Icon>dashboard</Icon>Dashboard
                        </ListItem>
                    </li>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin/mitra' exact
                        >
                            <Icon>assignment_ind</Icon>Mitra
                        </ListItem>
                    </li>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin/advertiser' exact
                        // isActive={() => this.sendTitle('Advertiser')}
                        >
                            <Icon>face</Icon>Advertiser
                        </ListItem>
                    </li>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin/mediaiklan'
                        // isActive={() => this.sendTitle('Media Iklan')}
                        >
                            <Icon>desktop_mac</Icon>Media Iklan
                        </ListItem>
                    </li>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin/negosiasi'
                        >
                            <Icon>question_answer</Icon>Negosiasi
                        </ListItem>
                    </li>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin/pembayaran'
                        >
                            <Icon>payment</Icon>Pembayaran
                        </ListItem>
                    </li>
                    <li>
                        <ListItem button classes={{button: classes.item}}
                        component={NavLink} to='/admin/laporan'
                        >
                            <Icon>pie_chart</Icon>Laporan
                        </ListItem>
                    </li>
                </List>
            </div>
        );
    }
}

export default withStyles(useStyles)(Sidebar);
