import React, { Component } from 'react';

import Preloading from '../../components/Material-UI/Preloading/Preloading';
import LoadingBar  from 'react-top-loading-bar';
import Backdrop from '@material-ui/core/Backdrop';
import {withStyles} from '@material-ui/core';
import CircularProgress from '@material-ui/core/CircularProgress';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import Icon from '@material-ui/core/Icon';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import Input from '@material-ui/core/Input';
import FilledInput from '@material-ui/core/FilledInput';
import OutlinedInput from '@material-ui/core/OutlinedInput';
import InputLabel from '@material-ui/core/InputLabel';
import InputAdornment from '@material-ui/core/InputAdornment';
import FormHelperText from '@material-ui/core/FormHelperText';
import FormControl from '@material-ui/core/FormControl';
import Visibility from '@material-ui/icons/Visibility';
import VisibilityOff from '@material-ui/icons/VisibilityOff';
import Box from '@material-ui/core/Box';
import Fade from 'react-reveal/Fade';
import { NavLink } from 'react-router-dom';
import {mainApi, configJSON} from '../../Controller/APIControll';
import { Redirect } from 'react-router';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import {prepareMount, pageOnProgress, onMounted, prepareSearch, onSearched } from '../../Actions/pageActions';
import {isAuth} from '../../Actions/AuthActions';

const urlimg = '/assets/img/pasangbaliho.png';
const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    },
    main: {
        paddingRight: '10px',
        paddingLeft: '10px',
        backgroundColor: '#EEEEEE',
        minHeight: '667px'
    },
    boxlogin: {
        padding: '20px 25px 20px 25px',
        boxShadow: '5px 5px 18px #888888',
    },
    formtitle: {
        fontSize: 16,
        fontWeight: '700',
        marginBottom: '20px'
    },
    loginnotif: {
        fontSize: 14,
        fontWeight: '400',
        marginBottom: '20px',
        borderStyle: 'solid',
        backgroundColor: '#F2DEDE',
        borderWidth: '1px',
        borderColor: '#EBCCD1',
        borderRadius: '5px',
        color: '#B94442',
        paddingTop: '10px',
        paddingBottom: '10px'
    }
}

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});
export class Login extends Component {

    constructor(props) {
        super(props);
        this.state = {
            username: '',
            password: '',
            showPassword: false,
            isLogin: false,
            loginNotif: '',
            loginProses: false
        }    
        this.handleLogin = this.handleLogin.bind(this)
    }
    
    
    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleShowPassword = () => {
        this.setState({
            showPassword: !this.state.showPassword
        })
    }

    handleKeyDown = (e) => {
        if (e.key === 'Enter') {
            this.handleLogin()
        }
    }
    handleLogin = async () => {

        const data = {
            username: this.state.username,
            password: this.state.password
        }
        this.setState({
            loginProses: true
        })
        let res = await this.props.isAuth(data);
        if(res.status === 200){
            this.setState({isLogin: true, loginProses: false,})
        } else if (res.status === 202){
            this.setState({loginProses: false, loginNotif: res.message})
        }else{
            this.setState({loginProses: false})
        }
    }
    
    async componentDidMount () {
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Mempersiapkan Halaman...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Mempersiapkan Halaman...')
        setTimeout(
            function(){
                this.props.onMounted('')
            }.bind(this), 2000
        );
    }
    render() {
          const user = localStorage.getItem('user');
          const {pageProgress, pageLoadingStatus, pageLoading, dataLoading} = this.props.page;
          const { classes } = this.props;

          if(user !== null || this.state.isLogin === true){
            return <Redirect to='/dashboard' />
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
            <div >
                <Box display='flex' justifyContent='center' alignItems='center' style={style.main}>
                <Grid container justify='center'  spacing={2}>
                    <Grid item xs={12} sm={4} md={4} lg={3}>
                        <Fade right>
                        <Box display='flex' justifyContent='center' style={{marginBottom: '20px'}}>
                            <img src={`${urlimg}`} height='35'/>
                        </Box>
                        </Fade>
                        <Fade bottom>
                        <Paper style={style.boxlogin}>
                            <Box display='flex' justifyContent='center' style={style.formtitle}>Admin Login</Box>
                            {
                                this.state.loginNotif !== '' ?
                                <Box display='flex' justifyContent='center' style={style.loginnotif}>{this.state.loginNotif}</Box>
                                :
                                ''
                            }
                            <Box style={{marginBottom: '20px'}}>
                                <FormControl variant='outlined' fullWidth>
                                <InputLabel htmlFor="username">Username</InputLabel>
                                <OutlinedInput
                                    margin="dense"
                                    name='username' id="username"
                                    type='text'
                                    value={this.state.username}
                                    onChange={this.handleChange}
                                    startAdornment={
                                        <InputAdornment position="start">
                                            <Icon style={{color: '#6C6C6C'}}>account_circle</Icon>
                                        </InputAdornment>
                                    }
                                    labelWidth={70}
                                />
                                </FormControl>
                            </Box>
                            <Box style={{marginBottom: '20px'}}>
                            <FormControl variant='outlined' fullWidth>
                            <InputLabel htmlFor="password">Password</InputLabel>
                            <OutlinedInput
                                name='password' id="password"
                                margin="dense"
                                type={this.state.showPassword ? 'text' : 'password'}
                                value={this.state.password}
                                onChange={this.handleChange}
                                onKeyDown={this.handleKeyDown}
                                startAdornment={
                                    <InputAdornment position="start">
                                        <Icon style={{color: '#6C6C6C'}}>lock</Icon>
                                    </InputAdornment>
                                }
                                endAdornment={
                                <InputAdornment position="end">
                                    <IconButton
                                    aria-label="toggle password visibility"
                                    onClick={this.handleShowPassword}
                                    edge="end"
                                    >
                                    {this.state.showPassword ? <Visibility /> : <VisibilityOff />}
                                    </IconButton>
                                </InputAdornment>
                                }
                                labelWidth={70}
                            />
                            </FormControl>
                            </Box>
                            <Box display='flex' justifyContent="flex-end">
                            <Button variant="contained" color="primary" onClick={this.handleLogin}>
                                Login
                            </Button>
                            </Box>
                        </Paper>  
                        </Fade>
                    </Grid>
                </Grid>
                </Box>
                <Backdrop
                    className={classes.backdrop}
                    open={this.state.loginProses}
                >
                    <Box display='flex' justifyContent='center' alignItems='center'>
                        <Box>
                            <Box display='flex' justifyContent='center' style={{marginBottom: '10px'}}>
                                <CircularProgress color="inherit" />
                            </Box>
                            <Box display='flex' justifyContent='center' alignItems='center'>
                            Autentikasi Akun...
                            </Box>
                        </Box>
                    </Box>
                    
                </Backdrop>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        isAuth: bindActionCreators(isAuth, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps)
    )(Login);
