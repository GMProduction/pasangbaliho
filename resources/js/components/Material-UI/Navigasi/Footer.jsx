import React, { Component } from 'react';
import AppBar from '@material-ui/core/AppBar';
import {withStyles} from '@material-ui/core';
import Box from '@material-ui/core/Box';
import Toolbar from '@material-ui/core/Toolbar';


const drawerWidth = 250;
const useStyles = theme => ({
    root: {
      display: 'flex',
    },
    navbar:{
      backgroundColor: '#EEEEEE',
      color: '#555555',
      top: 'auto',
      bottom: 0,
      height: '55px',
      marginLeft: '0px',
      paddingLeft: '20px',
      paddingRight: '20px',
      position: 'static',
      [theme.breakpoints.up('md')]: {
        width: `calc(100% - ${drawerWidth}px)`,
        position: 'static',
        marginLeft: drawerWidth,
      },
      
    },
  });
export class Footer extends Component {
    render() {
        const { classes } = this.props;
        return (
            <div className={classes.root}>
                <AppBar className={classes.navbar}>
                  <Toolbar variant='dense'>
                    <Box display="flex" p={1} fontFamily='Roboto Regular' style={{ width: '100%'}} alignItems='center'>
                      Admin Panel Pasang Baliho
                    </Box>
                  </Toolbar>
                
                </AppBar>
            </div>
        );
    }
}

export default withStyles(useStyles)(Footer);
