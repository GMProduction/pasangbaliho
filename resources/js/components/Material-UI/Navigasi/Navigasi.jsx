import React, { Component } from 'react';
import AppBar from '@material-ui/core/AppBar';
import Hidden from '@material-ui/core/Hidden';
import Drawer from '@material-ui/core/Drawer';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import PowerSettingsNewIcon from '@material-ui/icons/PowerSettingsNew';
import MenuIcon from '@material-ui/icons/Menu';
import {withStyles} from '@material-ui/core';
import Sidebar from './Sidebar';
import Box from '@material-ui/core/Box';
import Icon from '@material-ui/core/Icon';
import Tooltip from '@material-ui/core/Tooltip';
import Zoom from '@material-ui/core/Zoom';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import Button from '@material-ui/core/Button';
import { Redirect } from 'react-router'


const drawerWidth = 250;
const urlimg = '/assets/properties/cloud.jpg';
const useStyles = theme => ({
    root: {
      display: 'flex',
    },
    navbar:{
      backgroundColor: '#EEEEEE',
      color: '#555555',
      marginLeft: drawerWidth,
      fontFamily: 'Roboto Light',
      [theme.breakpoints.up('md')]: {
        width: `calc(100% - ${drawerWidth}px)`,
        position: 'static'
      },
      
    },
    menuButton: {
      marginRight: theme.spacing(2),
      [theme.breakpoints.up('md')]: {
          display: 'none',
        },
    
    },
    title: {
      flexGrow: 1,
    },
    drawer: {
      [theme.breakpoints.up('md')]: {
        width: drawerWidth,
        flexShrink: 0,
      },
    },
    drawerPaper: {
      width: drawerWidth,
      boxShadow: '2px 0px 20px grey',
      backgroundImage: `url(${urlimg})`
    },
  });


export class Navigasi extends Component {

    constructor(props) {
        super(props);
        this.state = {
            openSidebar: false,
            isLogout: false
        } 
        this.handleSidebar = this.handleSidebar.bind(this);
    }
    
    handleLogout = () => {
      localStorage.removeItem("user");
      this.setState({
        isLogout: true
      })
  }

    handleSidebar () {
        this.setState({
          openSidebar: !this.state.openSidebar
        })
      }

    render() {
        const { classes } = this.props;
        const user = localStorage.getItem('user');
          if(user === null || this.state.isLogout === true){
            return <Redirect to='/'/>
          }
        return (
            <div className={classes.root}>
                <AppBar className={classes.navbar} elevation={0}>
                    <Toolbar variant='dense'>
                        <Box display="flex" p={1} style={{ width: '100%'}} alignItems='center'>
                          <IconButton edge="start" 
                          className={classes.menuButton} 
                          color="inherit" 
                          aria-label="menu"
                          onClick={this.handleSidebar}>
                              <MenuIcon/>
                          </IconButton>
                          <Box p={1} flexGrow={1} fontSize={18}>{this.props.page.pageTitle}</Box>
                          <Box p={1} ml={2}>
                          <Tooltip TransitionComponent={Zoom} title="Logout">
                          <IconButton
                            size='small'
                            edge='end'
                            color="inherit" 
                            aria-label="Logout"
                            onClick={this.handleLogout}>
                                <PowerSettingsNewIcon />
                          </IconButton>
                          </Tooltip>
                          </Box>
                        </Box>
                        
                    </Toolbar>
                </AppBar>
                <nav aria-label="mailbox folders">
                <Hidden mdUp implementation="css">
                  <Drawer
                    variant="temporary"
                    anchor='left'
                    ModalProps={{
                      keepMounted: true, // Better open performance on mobile.
                    }}
                    classes={{
                      paper: classes.drawerPaper,
                    }}
                    open={this.state.openSidebar}
                    onClose={this.handleSidebar}
                    transitionDuration={500}
                  >
                    <Sidebar/>
                  </Drawer>
                </Hidden>
                <Hidden smDown implementation="css">
                  <Drawer
                  variant="permanent"
                  open
                  classes={{
                    paper: classes.drawerPaper,
                  }}
                  >
                    <Sidebar/>
                  </Drawer>
                </Hidden>
                </nav>
            </div>
        );
    }
}

function mapStateToProps(state) {
  return{
    page: state.PageReducer
  }
}


export default compose(
  withStyles(useStyles),
  connect(mapStateToProps)
  )(Navigasi);
