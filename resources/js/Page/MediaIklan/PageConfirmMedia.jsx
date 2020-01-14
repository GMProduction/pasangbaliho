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
import Backdrop from '@material-ui/core/Backdrop';
import CircularProgress from '@material-ui/core/CircularProgress';
import {withStyles} from '@material-ui/core';
import NumberFormat from 'react-number-format';
import Dropzone from 'react-dropzone';
import Snackbar from '@material-ui/core/Snackbar';
import MuiAlert from '@material-ui/lab/Alert';

import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import { Redirect } from 'react-router'
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import Grid from '@material-ui/core/Grid';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchMediaByID, postMedia, uploadImage} from '../../Actions/MediaIklanActions';
import {fetchKategori, fetchProvinsi, fetchKota} from '../../Actions/UtilityActions';
import {fetchMitra} from '../../Actions/MitraActions';
import {prepareMount, pageOnProgress, onMounted, redirectPage } from '../../Actions/pageActions';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', link:'/dashboard/mediaiklan', active: false},
    {title: 'Form Media', icon: 'note',  active: true},
];

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
        height: 18
    },
    resizeselect: {
        fontSize: 14, 
        fontFamily: 'Roboto Regular',
        height: 45
    },
    alert: {
        borderStyle: 'solid',
        backgroundColor: '#F2DEDE',
        borderWidth: '1px',
        borderColor: '#EBCCD1',
        borderRadius: '5px',
        color: '#B94442', padding: '20px', marginBottom: '20px'
    }
}

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
});
export class PageConfirmMedia extends Component {

    constructor(props) {
        super(props);
        this.onDrop = (files) => {
            this.setState({files})
        };
        this.state = {
            idBaliho: '',idClient : '',namaClient : '',idKategori : '',namaMedia: '',lebar: 0,tinggi: '0', orientasi: 'potrait', alamat: '',idProvinsi: '', idKota: '',
            posisi:'Stand Alone', tampilan: '1', alamat: '', hargaClient: '0', deskripsi: '', 
            hargaMarket: 0,latitude: '',longitude: '',url360: '', files: [], submitProses: false, error: false, succes: false,
            redirect: false
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
                idKota: this.props.utility.dataKota[0].id_kota
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
            orientasi: data.orientasi,
            idProvinsi: data.id_provinsi,
            idKota: data.id_kota,
            alamat: data.alamat,
            tampilan: data.tampilan,
            posisi: data.posisi,
            hargaClient: data.harga_client,
            deskripsi: data.deskripsi,
            hargaMarket: data.harga_market,
            latitude: data.latitude,
            longitude: data.longitude,
            url360: data.url_360
        })
    }

    handleUpload = async (id) => {
        let dataUpload = new FormData();
        if(this.state.files.length > 0){
            this.state.files.forEach((image_file) => {
                dataUpload.append('gambar[]', image_file);
            });
        }
        let idBaliho = id;
        dataUpload.append('idBaliho', idBaliho)
        let resUpload = await this.props.uploadImage(dataUpload)
        if(resUpload.status !== 'success'){
            this.setState({error: true,success: false})
        }else{
            this.setState({error: false,success: true})
        }
    }

    handleSave = async (status) => {
        let filter = this.props.filter
        let data = new FormData();
        
        let param = '';
        if(filter !== 'add'){param = 'patch';}
        Object.keys(this.state).map( row => {
            data.append(row, this.state[row])
        })
        data.append('status', status)
        
        this.setState({submitProses: true,})
        let res = await this.props.postMedia(data, param)
        if (res.status !== 'success'){
            this.setState({error: false,success: true})
            this.setState({submitProses: false})
        }else{
            if((filter === 'add') || (filter === 'pending')){
                if(this.state.files.length > 0){
                    await this.handleUpload(res.id)
                }else{
                    this.setState({error: false,success: true})
                }
                if(filter === 'pending'){
                    this.setState({
                        redirect: true
                    })
                }else{
                    this.clearField('add')
                    this.setState({submitProses: false})
                }
            }else{
                this.setState({error: false,success: true})
                this.setState({submitProses: false})
            }
        }
        
    }

    clearField = (param) => {
        if(param === 'add'){
            this.setState({
                namaMedia: '',lebar: 0,tinggi: 0, orientasi: 'potrait', alamat: '',
                posisi:'Stand Alone', tampilan: '1', alamat: '', hargaClient: '0', deskripsi: '', 
                hargaMarket: 0,latitude: '',longitude: '',url360: '', files: []
            })
            this.addProperti()
        }
        
    }
    addProperti = async () => {
        if(this.props.utility.dataKategori.length > 0){
            this.setState({
                idKategori: this.props.utility.dataKategori[0].id_kategori
            })
        }
        let firstProv = this.props.utility.dataProvinsi[0]
        this.setState({
            idProvinsi: this.props.utility.dataProvinsi[0].id_provinsi
        })
        await this.props.fetchKota(firstProv.id_provinsi)
        this.setState({
            idKota: this.props.utility.dataKota[0].id_kota
        })
    }

    patchProperti = async (param) => {
        let id = this.props.match.params.id;
        await this.props.fetchMediaByID('', id)
        if (this.props.mediaiklan.dataMediaByIdFound === true) {
            let idProv = this.props.mediaiklan.dataMediaById.id_provinsi
            await this.props.fetchKota(idProv)
            this.initState(this.props.mediaiklan.dataMediaById)
        }
    }
    async componentDidMount () {
        let filter = this.props.filter
        await this.props.prepareMount('Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        await this.props.pageOnProgress(30, 'Mohon tunggu Sebentar. Sedang Melakukan Fetch Data...')
        this.props.fetchMitra('')
        this.props.fetchKategori()
        await this.props.fetchProvinsi()
        if(filter !== 'add'){
            await this.patchProperti('')
        }else{
            await this.addProperti()
        }
        await this.props.onMounted('Media Iklan')
        
    }

    componentWillUnmount () {
        this.props.redirectPage(false)
    }

    handleCloseSnackBar = (param) => {
        if(param === 'error'){
            this.setState({
                error: false
            })
        }else{
            this.setState({
                success: false
            })
        }
    }
    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataMediaByIdFound} = this.props.mediaiklan;
        const {dataMitra} = this.props.mitra;
        const {dataKategori, dataProvinsi, dataKota} = this.props.utility;
        const files = this.state.files.map(file => (
            <li key={file.name}>
              {file.name}
            </li>
          ));
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

        if (this.state.redirect === true) {
            let url = '/dashboard/mediaiklan/permintaan';
            return <Redirect to={url} />
        }
        return (
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
                <Snackbar anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }} open={this.state.error} autoHideDuration={3000} onClose={() => this.handleCloseSnackBar('error')}>
                    <Alert onClose={() => this.handleCloseSnackBar('error')} color="error">
                        Gagal Dalam Menyimpan Data. harap Isi Data Dengan Benar.
                    </Alert>
                </Snackbar>
                <Snackbar anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }} open={this.state.success} autoHideDuration={3000} onClose={() => this.handleCloseSnackBar('success')}>
                    <Alert onClose={() => this.handleCloseSnackBar('success')} color="success">
                        Berhasil Menyimpan Data.
                    </Alert>
                </Snackbar>
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
                                        <Autocomplete 
                                            id="combo-box-demo" 
                                            margin='dense' 
                                            size="small"
                                            options={dataMitra}
                                            getOptionLabel={option => option.nama}
                                            renderInput={params => (
                                                <TextField {...params}
                                                
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
                                <NumberFormat fullWidth InputProps={{style: style.resize, endAdornment: <InputAdornment position="end">Cm</InputAdornment>}} InputLabelProps={{style: style.resize}} value={this.state.lebar} onValueChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({lebar: formattedValue})
                                    }
                                } customInput={TextField} label="Lebar" margin="dense" variant="outlined" thousandSeparator={'.'} decimalSeparator=','/>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                                <NumberFormat fullWidth InputProps={{style: style.resize, endAdornment: <InputAdornment position="end">Cm</InputAdornment>}} InputLabelProps={{style: style.resize}} value={this.state.tinggi} onValueChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({tinggi: formattedValue})
                                    }
                                } customInput={TextField} label="Tinggi" margin="dense" variant="outlined" thousandSeparator={'.'} decimalSeparator=','/>
                            </Grid>
                        </Grid>
                        <FormControl variant='outlined' margin='dense' fullWidth>
                                <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                    Orientasi
                                </InputLabel>
                                <Select
                                    id="demo-simple-select-outlined"
                                    value={this.state.orientasi}
                                    onChange={this.handleChange}
                                    labelWidth={80}
                                    style={style.resize}
                                    name='orientasi'
                                    >
                                        <MenuItem value='potrait' style={style.resize}>Potrait</MenuItem>
                                        <MenuItem value='landscape' style={style.resize}>Landscape</MenuItem>
                                </Select>
                            </FormControl>
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
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <FormControl variant='outlined' margin='dense' fullWidth>
                                    <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                        Posisi
                                    </InputLabel>
                                    <Select
                                        id="demo-simple-select-outlined"
                                        value={this.state.posisi}
                                        onChange={this.handleChange}
                                        labelWidth={80}
                                        style={style.resize}
                                        name='posisi'
                                        >
                                            <MenuItem value='Stand Alone' style={style.resize}>Stand Alone</MenuItem>
                                            <MenuItem value='Attach By Building' style={style.resize}>Attach By Building</MenuItem>
                                    </Select>
                                </FormControl>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <FormControl variant='outlined' margin='dense' fullWidth>
                                <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
                                    Tampilan Muka
                                </InputLabel>
                                <Select
                                    id="demo-simple-select-outlined"
                                    value={this.state.tampilan}
                                    onChange={this.handleChange}
                                    labelWidth={80}
                                    style={style.resize}
                                    name='tampilan'
                                    >
                                        <MenuItem value='1' style={style.resize}>1 Muka</MenuItem>
                                        <MenuItem value='2' style={style.resize}>2 Muka</MenuItem>
                                </Select>
                            </FormControl>
                            </Grid>
                        </Grid>
                        <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.alamat} onChange={this.handleChange}/>
                        <NumberFormat fullWidth InputProps={{style: style.resize, startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} InputLabelProps={{style: style.resize}} value={this.state.hargaClient} onValueChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({hargaClient: formattedValue})
                                    }
                                } customInput={TextField} label="Harga Mitra" margin="dense" variant="outlined" thousandSeparator={'.'} decimalSeparator=','/>
                        <TextField name='deskripsi' id="deskripsi" label="Deskripsi" margin="dense" variant="outlined" fullWidth multiline rows="5"
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
                    <NumberFormat fullWidth InputProps={{style: style.resize, startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} InputLabelProps={{style: style.resize}} value={this.state.hargaMarket} onValueChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({hargaMarket: formattedValue})
                                    }
                                } customInput={TextField} label="Harga Market" margin="dense" variant="outlined" thousandSeparator={'.'} decimalSeparator=','/>
                    <TextField name='latitude' id="latitude" label="Latitude" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.latitude}/>
                    <TextField name='longitude' id="longitude" label="Longitude" margin="dense" variant="outlined" fullWidth
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.longitude}/>
                    <TextField name='url360' id="url360" label="URL 360" margin="dense" variant="outlined" fullWidth 
                                    InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} 
                                    onChange={this.handleChange} value={this.state.url360}/>
                    {
                        this.props.filter !== 'update' ?
                        <Box style={{borderStyle: 'solid', borderColor: '#eeeeee', borderWidth: '2px', borderRadius: '2px', padding: '10px'}}>
                            <Dropzone onDrop={this.onDrop} accept='image/jpeg, image/png, image/jpg' multiple>
                                {({getRootProps, getInputProps}) => (
                                <section className="container" >
                                    <Box {...getRootProps({className: 'dropzone'})} display='flex' alignItems='center' justifyContent='center' style={{minHeight: '100px', borderStyle: 'dashed', backgroundColor: '#fafafa', borderColor: '#eeeeee', padding: '10px'}}>
                                        <input {...getInputProps()} multiple />
                                        <p style={{color: 'black'}}>Geser dan Letakkan Gambar Di Sini, Atau Klik Untuk Memilih Gambar</p>
                                    </Box>
                                    <aside>
                                    <h4>Files</h4>
                                    <ul>{files}</ul>
                                    </aside>
                                </section>
                                )}
                            </Dropzone>
                        </Box>
                        :
                        ''
                    }
                    
                    
                    <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            {this.props.filter !== 'add' ?
                            <Button variant="outlined" color="secondary" startIcon={<Icon>close</Icon>} onClick={() => this.handleSave('block')}>
                                Block
                            </Button>
                            : ''}
                            <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.handleSave('publish')}>
                                {this.props.filter === 'add' ? 'Simpan' : 'Publish'}
                            </Button>
                        </Box>
                    </BasicPanelContent>
                </BasicPanel>
                        </Grid>
                    </Grid>
                    
                </Fade>
                <Backdrop
                    className={classes.backdrop}
                    open={this.state.submitProses}
                >
                    <Box display='flex' justifyContent='center' alignItems='center'>
                        <Box>
                            <Box display='flex' justifyContent='center' style={{marginBottom: '10px'}}>
                                <CircularProgress color="inherit" />
                            </Box>
                            <Box display='flex' justifyContent='center' alignItems='center'>
                            Mohon Tunggu Sebentar. Sedang Menyimpan Data...
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
        mediaiklan: state.MediaIklanReducer,
        utility: state.UtilityReducer,
        mitra: state.MitraReducer,
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
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        redirectPage: bindActionCreators(redirectPage, dispatch),
        postMedia: bindActionCreators(postMedia, dispatch),
        uploadImage: bindActionCreators(uploadImage, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps)
    )(PageConfirmMedia);

function Alert(props) {
        return <MuiAlert elevation={6} variant="filled" {...props} />;
}