import React, { Component } from 'react';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import { NavLink } from 'react-router-dom';
import { Redirect } from 'react-router'
import Icon from '@material-ui/core/Icon';
import Paper from '@material-ui/core/Paper';
import Box from '@material-ui/core/Box';
import {withStyles} from '@material-ui/core';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import TextField from '@material-ui/core/TextField';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { breadcumbStyle } from '../../Style/Breadcumb';
import Grid from '@material-ui/core/Grid';
import { loadPermintaanMediaById, KonfirmasiMedia } from '../../Controller/MediaIklanControll';
import { Divider } from '@material-ui/core';
import Button from '@material-ui/core/Button';
import InputAdornment from '@material-ui/core/InputAdornment';


const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    },
    adornment:{
        marginRight: '-12px'
    },
}

export class PagePersetujuanMedia extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
            isLoading: true,
            idClient : '',namaClient : '',kategori : '',namamedia: '',lebar: '0',tinggi: '0',alamat: '',provinsi: '', kota: '',
            alamat: '', hargaClient: '0', deskripsi: '', hargaMarket: 0,latitude: '',longitude: '',url360: '',
            gambar1: null,gambar2: null,gambar3: null,gambar4: null,gambar5: null,gambar6: null, dataFound: false, toMedia: false
        }
    }

    handleChange = async (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleChangeGambar = (e) => {
        this.setState({
            [e.target.name]: e.target.files[0],
        })
        console.log(e.target.files[0]);
        
    }

    update = async (status) => {
        let data = new FormData();
        let id = this.props.match.params.id
        data.append('hargaMarket', this.state.hargaMarket);
        data.append('latitude', this.state.latitude);
        data.append('longitude', this.state.longitude);
        data.append('url360', this.state.url360);
        data.append('gambar1', this.state.gambar1);
        data.append('gambar2', this.state.gambar2);
        data.append('gambar3', this.state.gambar3);
        data.append('gambar4', this.state.gambar4);
        data.append('gambar5', this.state.gambar5);
        data.append('gambar6', this.state.gambar6);
        data.append('status', status);
        data.append('idbaliho', id);
        
          let res = await KonfirmasiMedia(data)
          console.log(res);
          if (res.data.status === 'ok') {
              this.setState({
                  toMedia: true
              })
          }
    }

    initData = async () => {
        this.setState({
            loadingBarProgress: 50,
        })
        let id = this.props.match.params.id;
        let data = await loadPermintaanMediaById(id);
        console.log(data);
        
        this.setState({
            loadingBarProgress: 100,
            isLoading: false,
            idClient: data.id_client,
            namaClient: data.nama,
            kategori: data.kategori,
            namamedia: data.nama_baliho,
            lebar: data.lebar,
            tinggi: data.tinggi,
            provinsi: data.nama_provinsi,
            kota: data.nama_kota,
            alamat: data.alamat,
            hargaClient: data.harga_client,
            deskripsi: data.deskripsi

        })
    }



    componentDidMount () {
        this.initData();
    }

    render() {
        const { classes } = this.props;
        if (this.state.toMedia === true) {
            return <Redirect to='/admin/mediaiklan/permintaan' />
        }
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
                            color="inherit" to="/admin/mediaiklan"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>question_answer</Icon>
                                Negosiasi
                            </NavLink>
                            <NavLink
                            color="inherit" to="/admin/mediaiklan/permintaan"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>local_offer</Icon>
                                Permintaan
                            </NavLink>
                        <Box display='flex' alignItems='center' style={{color: '#555555', fontFamily: 'Roboto Light', fontSize: '14px'}}>
                            <Icon className={classes.icon}>check_box</Icon>
                                Persetujuan Media
                            </Box>
                    </Breadcrumbs>
                </Paper>
                <Grid container spacing={2}>
                <Grid item xs={12} sm={12} md={7} lg={7}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Mitra Media</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                        <TextField name='namaClient' id="namaClient" label="Nama mitra" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaClient}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='kategori' id="kategori" label="Kategori" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.kategori}/>
                                    </Grid>
                                </Grid>
                                <TextField name='namamedia' id="namamedia" label="Nama Media" margin="dense" variant="outlined" fullWidth 
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namamedia}/>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='lebar' id="lebar" label="Lebar" margin="dense" variant="outlined" fullWidth type='number'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.lebar}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='tinggi' id="tinggi" label="Tinggi" margin="dense" variant="outlined" fullWidth type='number'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.tinggi}/>
                                    </Grid>
                                </Grid>
                                <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='provinsi' id="provinsi" label="Provinsi" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.provinsi}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='kota' id="kota" label="kota" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.kota}/>
                                    </Grid>
                                </Grid>
                                <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.alamat}/>
                                <TextField name='hargaClient' id="hargaClient" label="Tinggi" margin="dense" variant="outlined" fullWidth type='number'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.hargaClient}/>
                                <TextField name='deskripsi' id="deskripsi" label="deskripsi" margin="dense" variant="outlined" fullWidth multiline rows="5"
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.deskripsi}/>
                        </BasicPanelContent>
                    </BasicPanel>
                </Grid>
                <Grid item xs={12} sm={12} md={5} lg={5}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                            <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Umum</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <TextField name='hargaMarket' id="hargaMarket" label="Harga Market" margin="dense" variant="outlined" fullWidth type='number'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                        onChange={this.handleChange.bind(this)} value={this.state.hargaMarket}/>
                        <TextField name='latitude' id="latitude" label="Latitude" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                        onChange={this.handleChange.bind(this)} value={this.state.latitude}/>
                        <TextField name='longitude' id="longitude" label="Longitude" margin="dense" variant="outlined" fullWidth
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                        onChange={this.handleChange.bind(this)} value={this.state.longitude}/>
                        <TextField name='url360' id="url360" label="URL 360" margin="dense" variant="outlined" fullWidth 
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                        onChange={this.handleChange.bind(this)} value={this.state.url360}/>
                        <input accept="image/*" style={{display: 'none'}} id="gambar1" type="file" name='gambar1'
                                    onChange={this.handleChangeGambar.bind(this)}
                                />
                                <label htmlFor="gambar1">
                                    <TextField disabled label="Gambar 1" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.gambar1 !== null ? this.state.gambar1.name : ''}/>
                                </label>
                                <input accept="image/*" style={{display: 'none'}} id="gambar2" type="file" name='gambar2'
                                    onChange={this.handleChangeGambar.bind(this)}
                                />
                                <label htmlFor="gambar2">
                                <TextField disabled label="Gambar 2" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.gambar2 !== null ? this.state.gambar2.name : ''}/>
                                </label>
                                <input accept="image/*" style={{display: 'none'}} id="gambar3" type="file" name='gambar3'
                                    onChange={this.handleChangeGambar.bind(this)}
                                />
                                <label htmlFor="gambar3">
                                <TextField disabled label="Gambar 3" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.gambar3 !== null ? this.state.gambar3.name : ''}/>
                                </label>
                                <input accept="image/*" style={{display: 'none'}} id="gambar4" type="file" name='gambar4'
                                    onChange={this.handleChangeGambar.bind(this)}
                                />
                                <label htmlFor="gambar4">
                                <TextField disabled label="Gambar 4" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.gambar4 !== null ? this.state.gambar4.name : ''}/>
                                </label>
                                <input accept="image/*" style={{display: 'none'}} id="gambar5" type="file" name='gambar5'
                                    onChange={this.handleChangeGambar.bind(this)}
                                />
                                <label htmlFor="gambar5">
                                <TextField disabled label="Gambar 5" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.gambar5 !== null ? this.state.gambar5.name : ''}/>
                                </label>
                                <input accept="image/*" style={{display: 'none'}} id="gambar6" type="file" name='gambar6'
                                    onChange={this.handleChangeGambar.bind(this)}
                                />
                                <label htmlFor="gambar6">
                                <TextField disabled label="Gambar 6" variant="outlined" margin="dense" fullWidth
                                        InputProps={{style: style.resize,
                                            endAdornment: <InputAdornment position="end" style={style.adornment}>
                                                <Button style={style.resize} component="span">Browse</Button>
                                            </InputAdornment>
                                        }} InputLabelProps={{style: style.resize}}
                                        value={this.state.gambar6 !== null ? this.state.gambar6.name : ''}/>
                                </label>
                                <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                                <Box display="flex" justifyContent='flex-end' alignItems="center">
                                    <Button variant="contained" color="secondary" startIcon={<Icon>close</Icon>} onClick={() => this.update('block')}>
                                        Tolak
                                    </Button>
                                    <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.update('publish')}>
                                        Konfirmasi
                                    </Button>
                                </Box>
                        </BasicPanelContent>
                    </BasicPanel>
                </Grid>
                </Grid>
            </div>
        );
    }
}

export default  withStyles(breadcumbStyle)(PagePersetujuanMedia);
