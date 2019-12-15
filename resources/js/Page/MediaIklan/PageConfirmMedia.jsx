import React, { Component } from 'react';

import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import FormControl from '@material-ui/core/FormControl';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import Select from '@material-ui/core/Select';
import Icon from '@material-ui/core/Icon';
import InputAdornment from '@material-ui/core/InputAdornment';
import Divider from '@material-ui/core/Divider';
import Button from '@material-ui/core/Button';
import Autocomplete from '@material-ui/lab/Autocomplete';

import { Redirect } from 'react-router'
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import Grid from '@material-ui/core/Grid';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';
import {fetchMediaByID, fetchKota, fetchKategori, fetchProvinsi, fetchMitra,
    prepareMount, onMounted, formMediaValue, onUnMounted,
    prepareSubmit, onSubmit, postMedia} from '../../Actions/MediaIklanActions';


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

export class PageConfirmMedia extends Component {

    constructor(props) {
        super(props);
        this.state = {
            idBaliho: '',idClient : '',namaClient : '',idKategori : '',namaMedia: '',lebar: '0',tinggi: '0',alamat: '',idProvinsi: '', idKota: '',
            venue:'', alamat: '', hargaClient: '0', deskripsi: '',
            hargaMarket: 0,latitude: '',longitude: '',url360: '', gambar1: null, gambar2: null, gambar3: null
        }
    }

    handleChange = async (e) => {
        let value = e.target.value;
        this.setState({
            [e.target.name]: e.target.value
        })
        if (e.target.name === 'idProvinsi') {
            this.setState({
                idKota: ''
            })
            await this.props.fetchKota(value)
            this.setState({
                idKota: this.props.mediaiklan.dataKota[0].id_kota
            })
        }
    }

    handleChangeGambar = (e) => {
        if (e.target.files[0] !== undefined) {
            this.setState({
                [e.target.name]: e.target.files[0],
            })
        }else {
            this.setState({
                [e.target.name]: null
            })
        }
    }

    selectChange = (value) => {
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
    initState = (data) => {
        this.setState({
            idBaliho: data.id_baliho,
            idClient: data.id_client,
            namaClient: data.nama,
            idKategori: data.id_kategori,
            namaMedia: data.nama_baliho,
            lebar: data.lebar,
            tinggi: data.tinggi,
            idProvinsi: data.id_provinsi,
            idKota: data.id_kota,
            alamat: data.alamat,
            venue: data.venue,
            hargaClient: data.harga_client,
            deskripsi: data.deskripsi,
            hargaMarket: data.harga_market,
            latitude: data.latitude,
            longitude: data.longitude,
            url360: data.url_360
        })
    }

    handleSave = async (status) => {
        let data = new FormData();
        let filter = this.props.filter;
        Object.keys(this.state).map( row => {
            data.append(row, this.state[row])
        })
        data.append('status', status)
        let param = 'add'
        if (filter !== 'add') {
            param = 'update';   
        }
        
        await this.props.prepareSubmit()
        await this.props.postMedia(data, param)
        await this.props.onSubmit()
        console.log(this.state.status);
    }

    async componentDidMount () {
        let filter = this.props.filter
        if (filter !== 'add') {
            let id = this.props.match.params.id;
            this.props.prepareMount()
            await this.props.fetchMediaByID('pending', id)
            console.log(this.props);
            this.props.onMounted()
            if (this.props.mediaiklan.dataMediaByIdFound === true) {
                this.initState(this.props.mediaiklan.dataMediaById)
            }
        }else {
            this.props.prepareMount()
            await this.props.fetchMitra()
            await this.props.fetchKategori()
            await this.props.fetchProvinsi()
            let firstProv = this.props.mediaiklan.dataProvinsi[0]
            await this.props.fetchKota(firstProv.id_provinsi)
            this.props.onMounted()
        }
        
    }

    componentWillUnmount () {
        this.props.onUnMounted()
    }

    render() {
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataMediaByIdFound, dataKategori, dataProvinsi, dataKota, dataMitra} = this.props.mediaiklan;

        if (pageLoading === true) {
            return(
                <div>
                    <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                    <Preloading textloading={pageLoadingStatus}/>
                </div>
            )
        }

        if (dataMediaByIdFound !== true && this.props.filter !== 'add') {
            return(
                <div>
                    <h1>NOT FOUND</h1>
                </div>
            )
        }

        if (redirect === true) {
            let url = '/mediaiklan';
            if (this.props.filter === 'confirm') {
                url = '/mediaiklan/permintaan'
            }
            return <Redirect to={url} />
        }
        return (
            <div>
                <Fade bottom>
                    <Grid container spacing={2}>
                        <Grid item xs={12} sm={12} md={12} lg={7}>
                            
                        <BasicPanel>
                    <BasicPanelHeader color='#9129AC'>
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Mitra Media</Box>
                    </BasicPanelHeader>
                    <BasicPanelContent>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            {
                                this.props.filter === 'add' ?
                            
                            <Autocomplete id="combo-box-demo" margin='dense' 
                                            options={dataMitra}
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
                                :
                                <TextField disabled name='namaClient' id="namaClient" label="Nama mitra" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaClient} onChange={this.handleChange}/>
                            }
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                                <FormControl variant='outlined' margin='dense' fullWidth>
                                    <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                        Jenis Media
                                    </InputLabel>
                                    <Select
                                        id="demo-simple-select-outlined"
                                        value={this.state.idKategori}
                                        onChange={this.handleChange}
                                        labelWidth={80}
                                        style={style.resize}
                                        name='idKategori'
                                        >
                                        {
                                            dataKategori !== null ?
                                            dataKategori.map( (row, id) => {
                                                return (
                                                    <MenuItem key={id} value={row.id_kategori} style={style.resize}>{row.kategori}</MenuItem>
                                                )
                                            } )
                                            : <MenuItem value='' style={style.resize}>---</MenuItem>
                                        }
                                    </Select>
                                </FormControl>
                            </Grid>
                        </Grid>
                        <TextField name='namaMedia' id="namaMedia" label="Nama Media" margin="dense" variant="outlined" fullWidth 
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaMedia} onChange={this.handleChange}/>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <TextField name='lebar' id="lebar" label="Lebar" margin="dense" variant="outlined" fullWidth type='number'
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.lebar} onChange={this.handleChange}/>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <TextField name='tinggi' id="tinggi" label="Tinggi" margin="dense" variant="outlined" fullWidth type='number'
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.tinggi} onChange={this.handleChange}/>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <FormControl variant='outlined' margin='dense' fullWidth>
                                    <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                        Provinsi
                                    </InputLabel>
                                    <Select
                                        id="demo-simple-select-outlined"
                                        value={this.state.idProvinsi}
                                        onChange={this.handleChange}
                                        labelWidth={80}
                                        style={style.resize}
                                        name='idProvinsi'
                                        >
                                        {
                                            dataProvinsi !== null ?
                                            dataProvinsi.map( (row, id) => {
                                                return (
                                                    <MenuItem key={id} value={row.id_provinsi} style={style.resize}>{row.nama_provinsi}</MenuItem>
                                                )
                                            } )
                                            : <MenuItem value='' style={style.resize}>---</MenuItem>
                                        }
                                    </Select>
                                </FormControl>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <FormControl variant='outlined' margin='dense' fullWidth>
                                    <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                        Kota
                                    </InputLabel>
                                    <Select
                                        id="demo-simple-select-outlined"
                                        value={this.state.idKota}
                                        onChange={this.handleChange}
                                        labelWidth={80}
                                        style={style.resize}
                                        name='idKota'
                                        >
                                        {
                                            dataKota !== null ?
                                            dataKota.map( (row, id) => {
                                                return (
                                                    <MenuItem key={id} value={row.id_kota} style={style.resize}>{row.nama_kota}</MenuItem>
                                                )
                                            } )
                                            : <MenuItem value='' style={style.resize}>---</MenuItem>
                                        }
                                    </Select>
                                </FormControl>
                            </Grid>
                        </Grid>
                        <TextField name='venue' id="venue" label="Venue" margin="dense" variant="outlined" fullWidth
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.venue} onChange={this.handleChange}/>
                        <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.alamat} onChange={this.handleChange}/>
                        <TextField name='hargaClient' id="hargaClient" label="Harga Mitra" margin="dense" variant="outlined" fullWidth type='number'
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.hargaClient} onChange={this.handleChange}/>
                        <TextField name='deskripsi' id="deskripsi" label="deskripsi" margin="dense" variant="outlined" fullWidth multiline rows="5"
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.deskripsi} onChange={this.handleChange}/>
                    </BasicPanelContent>
                </BasicPanel>
                        </Grid>
                        {/* dataMarket */}
                        <Grid item xs={12} sm={12} md={12} lg={5}>
                        <BasicPanel>
                    <BasicPanelHeader color='#9129AC'>
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Umum</Box>
                    </BasicPanelHeader>
                    <BasicPanelContent>
                    <TextField name='hargaMarket' id="hargaMarket" label="Harga Market" margin="dense" variant="outlined" fullWidth type='number'
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.hargaMarket}/>
                    <TextField name='latitude' id="latitude" label="Latitude" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.latitude}/>
                    <TextField name='longitude' id="longitude" label="Longitude" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.longitude}/>
                    <TextField name='url360' id="url360" label="URL 360" margin="dense" variant="outlined" fullWidth 
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.url360}/>
                    <input accept="image/*" style={{display: 'none'}} id="gambar1" type="file" name='gambar1'
                        onChange={this.handleChangeGambar}
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
                    onChange={this.handleChangeGambar}
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
                    onChange={this.handleChangeGambar}
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
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            {this.props.filter !== 'add' ?
                            <Button variant="contained" color="secondary" startIcon={<Icon>close</Icon>} onClick={() => this.handleSave('block')}>
                                Tolak
                            </Button>
                            : ''}
                            <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.handleSave('publish')}>
                                {this.props.filter === 'add' ? 'Simpan' : 'Publish'}
                            </Button>
                        </Box>
                    </BasicPanelContent>
                </BasicPanel>
                        </Grid>
                    </Grid>
                    
                </Fade>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return{
        mediaiklan: state.MediaIklanReducer,
        page: state.PageReducer
    }
}

function mapDispatcToProps (dispatch) {
    return {
        fetchMediaByID: bindActionCreators(fetchMediaByID, dispatch),
        fetchMitra: bindActionCreators(fetchMitra, dispatch),
        fetchKategori: bindActionCreators(fetchKategori, dispatch),
        fetchProvinsi: bindActionCreators(fetchProvinsi, dispatch),
        fetchKota: bindActionCreators(fetchKota, dispatch),
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        formMediaValue: bindActionCreators(formMediaValue, dispatch),
        onUnMounted: bindActionCreators(onUnMounted, dispatch),
        prepareSubmit: bindActionCreators(prepareSubmit, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        postMedia: bindActionCreators(postMedia, dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatcToProps)
    )(PageConfirmMedia);
