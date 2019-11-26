import React, { Component } from 'react';
import AppBar from '@material-ui/core/AppBar';
import Hidden from '@material-ui/core/Hidden';
import Drawer from '@material-ui/core/Drawer';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/icons/Menu';
import {withStyles} from '@material-ui/core';
import Sidebar from './Sidebar';
import Box from '@material-ui/core/Box';
import Icon from '@material-ui/core/Icon';
import Tooltip from '@material-ui/core/Tooltip';
import Zoom from '@material-ui/core/Zoom';


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
        } 
        this.handleSidebar = this.handleSidebar.bind(this);
    }
    
    handleSidebar () {
        this.setState({
          openSidebar: !this.state.openSidebar
        })
      }

    render() {
        const { classes } = this.props;
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
                          <Box p={1} flexGrow={1} fontSize={18}>Dashboard</Box>
                          <Box p={1}>
                            <Tooltip TransitionComponent={Zoom} title="Permintaan Harga Advertiser">
                            <Icon>question_answer</Icon>
                            </Tooltip>
                          </Box>
                          <Box p={1} ml={2}>
                            <Tooltip TransitionComponent={Zoom} title="Permintaan Penambahan Media">
                            <Icon>desktop_mac</Icon>
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

export default withStyles(useStyles)(Navigasi);
