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
import { addMedia } from '../../Controller/MediaIklanControll';
import { loadMitra } from '../../Controller/MitraControll';
import {  loadKategori } from '../../Controller/KategoriControll';
import {  loadProvinsi, loadKota} from '../../Controller/LokasiControll';
import { Divider } from '@material-ui/core';
import Button from '@material-ui/core/Button';
import InputAdornment from '@material-ui/core/InputAdornment';
import Autocomplete from '@material-ui/lab/Autocomplete';
import FormControl from '@material-ui/core/FormControl';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';
import MenuItem from '@material-ui/core/MenuItem';
import Axios from 'axios';

const style = {
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular'
    },
    adornment:{
        marginRight: '-12px'
    },
    resizeautocomplete: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular',
        height: 0
    },
    resizeselect: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular',
        height: 45
    }

}

export class PageAddMedia extends Component {
    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
            isLoading: true,
            listMitra: [],
            listkategori: [],
            listprovinsi: [],
            listkota: [],
            idClient : '',namaClient : '',kategori : '',namamedia: '',lebar: '0',tinggi: '0',alamat: '',provinsi: '', kota: '',
            alamat: '', hargaClient: '0', deskripsi: '', hargaMarket: 0,latitude: '',longitude: '',url360: '',
            gambar1: null,gambar2: null,gambar3: null,gambar4: null,gambar5: null,gambar6: null, dataFound: false, toMedia: false
        }
    }

    handleChange = async (e) => {
        
        this.setState({
            [e.target.name]: e.target.value
        })
        if (e.target.name === 'provinsi') {
            let kota = await loadKota(e.target.value);
            if (kota.length > 0) {
                this.setState({
                    listkota: kota,
                    kota: kota[0].id_kota
                })
            }
        }
    }

    handleChangeGambar = (e) => {
        // this.setState({
        //     [e.target.name]: e.target.files[0],
        // })
        console.log(e.target);
        
    }

    selectChange = (value) => {
        console.log(value);
        if (value === null) {
            this.setState({
                namaClient: '',
                idClient: ''
            })
        }else{
            this.setState({
                namaClient: value.nama,
                idClient: value.id_client
            })
        }
    }
    
    save = async () => {
        let data = new FormData();
        let luas = this.state.lebar * this.state.tinggi
        data.append('idClient', this.state.idClient);
        data.append('idKategori', this.state.kategori);
        data.append('namaBaliho', this.state.namamedia);
        data.append('lebar', this.state.lebar);
        data.append('tinggi', this.state.tinggi);
        data.append('luas', luas);
        data.append('idProvinsi', this.state.provinsi);
        data.append('idKota', this.state.kota);
        data.append('alamat', this.state.alamat);
        data.append('latitude', this.state.latitude);
        data.append('longitude', this.state.longitude);
        data.append('hargaClient', this.state.hargaClient);
        data.append('hargaMarket', this.state.hargaMarket);
        data.append('orientasi', this.state.orientasi);
        data.append('venue', this.state.venue);
        data.append('deskripsi', this.state.deskripsi);
        data.append('url360', this.state.url360);
        data.append('gambar1', this.state.gambar1);
        data.append('gambar2', this.state.gambar2);
        data.append('gambar3', this.state.gambar3);
        data.append('gambar4', this.state.gambar4);
        data.append('gambar5', this.state.gambar5);
        data.append('gambar6', this.state.gambar6);
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            },
             onUploadProgress: (ProgressEvent) => {
                 var percent = Math.round((ProgressEvent.loaded * 100) / ProgressEvent.total);
                 console.log(percent);
             }
          }
        let res = await axios.post('http://localhost:8000/adminapi/mediaiklan/addmedia', data, config);
        console.log(res);
        // if (res.data.status === 'ok') {
        //     this.setState({
        //         toMedia: true
        //     })
        // }
    }

    initData = async () => {
        let mitra = await loadMitra();
        let kategori = await loadKategori();
        this.setState({
            listMitra: mitra,
            listkategori: kategori,
        })
        let provinsi = await loadProvinsi();
        if (provinsi.length > 0) {
            this.setState({
                listprovinsi: provinsi,
                provinsi: provinsi[0].id_provinsi,
            })
            let kota = await loadKota(provinsi[0].id_provinsi);
            if (kota.length > 0) {
                this.setState({
                    listkota: kota,
                    kota: kota[0].id_kota
                })
            }
        }
        
    }

    componentDidMount(){
        this.initData();
    }

    render() {
        const { classes } = this.props;
        if (this.state.toMedia === true) {
            return <Redirect to='/admin/mediaiklan' />
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
                            <Icon className={classes.icon}>desktop_mac</Icon>
                                Media Iklan
                            </NavLink>
                        <Box display='flex' alignItems='center' style={{color: '#555555', fontFamily: 'Roboto Light', fontSize: '14px'}}>
                            <Icon className={classes.icon}>note_add</Icon>
                                Penambahan Media
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
                                    <Autocomplete id="combo-box-demo" margin='dense' 
                                            options={this.state.listMitra}
                                            getOptionLabel={option => option.nama}
                                            renderInput={params => (
                                                <TextField {...params}
                                                inputProps={{...params.inputProps, style : style.resizeautocomplete}}
                                                InputLabelProps={{
                                                    ...params.InputLabelProps,
                                                    style: style.resizeautocomplete
                                                }}
                                                label="Mitra Media" variant="outlined" fullWidth margin="dense" />
                                            )}
                                            onChange={(event, value) => this.selectChange(value)} />
                                </Grid>
                                <Grid item xs={12} sm={12} md={12} lg={6}>
                                <FormControl variant="outlined" margin='dense' fullWidth>
                                            <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                                Jenis Media
                                            </InputLabel>
                                            <Select
                                            id="demo-simple-select-outlined"
                                            value={this.state.kategori}
                                            onChange={this.handleChange.bind(this)}
                                            labelWidth={80}
                                            style={style.resizeselect}
                                            name='kategori'
                                            >
                                                {this.state.listkategori.map((row, i) => {
                                                    return (
                                                    <MenuItem key={i} value={row.id_kategori} style={style.resize}>{row.kategori}</MenuItem>
                                                    )
                                                })}
                                            </Select>
                                    </FormControl>
                                </Grid>
                            </Grid>
                            <TextField name='namamedia' id="namamedia" label="Nama Media" margin="dense" variant="outlined" fullWidth 
                                            InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namamedia} onChange={this.handleChange.bind(this)}/>
                            <Grid container spacing={2}>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='lebar' id="lebar" label="Lebar" margin="dense" variant="outlined" fullWidth type='number'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.lebar} onChange={this.handleChange.bind(this)}/>
                                    </Grid>
                                    <Grid item xs={12} sm={12} md={12} lg={6}>
                                    <TextField name='tinggi' id="tinggi" label="Tinggi" margin="dense" variant="outlined" fullWidth type='number'
                                        InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.tinggi} onChange={this.handleChange.bind(this)}/>
                                    </Grid>
                            </Grid>
                            <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                                        <FormControl variant="outlined" margin='dense' fullWidth>
                                            <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                                Provinsi
                                            </InputLabel>
                                            <Select
                                            id="demo-simple-select-outlined"
                                            value={this.state.provinsi}
                                            onChange={this.handleChange.bind(this)}
                                            labelWidth={80}
                                            style={style.resize}
                                            name='provinsi'
                                            >
                                                {
                                                    this.state.listprovinsi.length > 0 ?
                                                    this.state.listprovinsi.map((row, i) => {
                                                        return(
                                                            <MenuItem key={i} value={row.id_provinsi} style={style.resize}>{row.nama_provinsi}</MenuItem>
                                                        )
                                                    }): <MenuItem value='' style={style.resize}></MenuItem>
                                                }
                                            </Select>
                                        </FormControl>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                                        <FormControl variant="outlined" margin='dense' fullWidth>
                                            <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                                Kota
                                            </InputLabel>
                                            <Select
                                            id="demo-simple-select-outlined"
                                            value={this.state.kota}
                                            onChange={this.handleChange.bind(this)}
                                            labelWidth={80}
                                            style={style.resize}
                                            name='kota'
                                            >
                                                {
                                                    this.state.listkota.length > 0 ?
                                                    this.state.listkota.map((row, i) => {
                                                        return(
                                                            <MenuItem key={i} value={row.id_kota} style={style.resize}>{row.nama_kota}</MenuItem>
                                                        )
                                                    }): <MenuItem value='' style={style.resize}></MenuItem>
                                                }
                                            </Select>
                                        </FormControl>
                            </Grid>
                            </Grid>
                            <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.alamat} onChange={this.handleChange.bind(this)}/>
                            <TextField  name='hargaClient' id="hargaClient" label="Harga Client" margin="dense" variant="outlined" fullWidth type='number'
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.hargaClient} onChange={this.handleChange.bind(this)}/>
                            <TextField  name='deskripsi' id="deskripsi" label="deskripsi" margin="dense" variant="outlined" fullWidth multiline rows="5"
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.deskripsi} onChange={this.handleChange.bind(this)}/>
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
                                    <Button variant="contained" color="secondary" startIcon={<Icon>close</Icon>} onClick={() => this.save()}>
                                        Batal
                                    </Button>
                                    <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.save()}>
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

export default withStyles(breadcumbStyle)(PageAddMedia);
