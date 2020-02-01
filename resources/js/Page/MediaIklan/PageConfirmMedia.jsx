import React, { Component } from 'react';

import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTextfield from '../../components/Material-UI/Textfield/BasicTextfield';
import Combobox from '../../components/Material-UI/Combobox/Combobox';
import NumberTextfield from '../../components/Material-UI/Textfield/NumberTextfield';
import Box from '@material-ui/core/Box';
import TextField from '@material-ui/core/TextField';
import MenuItem from '@material-ui/core/MenuItem';
import Icon from '@material-ui/core/Icon';
import IconButton from '@material-ui/core/IconButton';
import DeleteIcon from '@material-ui/icons/Delete';
import InputAdornment from '@material-ui/core/InputAdornment';

import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardActions from '@material-ui/core/CardActions';
import CardMedia from '@material-ui/core/CardMedia';

import Divider from '@material-ui/core/Divider';
import Button from '@material-ui/core/Button';
import Autocomplete from '@material-ui/lab/Autocomplete';
import {withStyles} from '@material-ui/core';
import Dropzone from 'react-dropzone';


import MBreadcumb from '../../components/Material-UI/Breadcumbs/MBreadcumb';
import RadioButton from '../../components/Material-UI/Radio/RadioButton';
import Question from '../../components/Material-UI/Dialog/Question';
import { Redirect } from 'react-router'
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import Grid from '@material-ui/core/Grid';
import compose from 'recompose/compose';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import Preloading from '../../components/Material-UI/Preloading/Preloading';

import {fetchMediaByID, postMedia, uploadImage, fetchImageById, deleteImage} from '../../Actions/MediaIklanActions';
import {fetchKategori, fetchKota} from '../../Actions/UtilityActions';
import {fetchMitra} from '../../Actions/MitraActions';
import {prepareMount, pageOnProgress, onMounted, onSubmit, onNotify} from '../../Actions/pageActions';


const breadcumbItems = [
    {title: 'Dashboard', icon: 'dashboard', link:'/dashboard', active: false},
    {title: 'Media Iklan', icon: 'desktop_mac', link:'/dashboard/mediaiklan', active: false},
    {title: 'Form Media', icon: 'note',  active: true},
];

const radioItems = [
    {label: 'Publish', value: 'publish'},
    {label: 'Block', value: 'block'}
];
const radioHargaItems = [
    {label: 'Terlihat', value: 'ya'},
    {label: 'Tidak terlihat', value: 'tidak'}
];

const useStyles = theme => ({
    backdrop: {
        zIndex: theme.zIndex.drawer + 1,
        color: '#fff',
        },
    media: {
        height: 140,
        },
        iconButton: {
            color: '#555555',
            marginLeft: '5px'
        }
});
export class PageConfirmMedia extends Component {

    constructor(props) {
        super(props);
        this.onDrop = (files) => {
            this.setState({files})
        };
        this.state = {
            idBaliho: '',idClient : '',namaClient : '',idKategori : '',namaMedia: '',lebar: 0,tinggi: '0', orientasi: 'potrait', alamat: '', idKota: '',
            posisi:'Stand Alone', tampilan: '1', alamat: '', hargaClient: '0', deskripsi: '', statusHarga: 'tidak terlihat',
            hargaMarket: 0, hargaMax: 0, latitude: '',longitude: '',url360: '', files: [], status: 'publish', redirect: false, dialogOpen: false, dialogTitle: '',
            dialogMessage: '', idgambar: ''
        }
    }


    handleChange = async (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    selectChange = (value) => {
        console.log(value)
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
            idKota: data.id_kota,
            alamat: data.alamat,
            tampilan: data.tampilan,
            posisi: data.posisi,
            hargaClient: data.harga_client,
            deskripsi: data.deskripsi,
            hargaMarket: data.harga_market,
            hargaMax: data.harga_max,
            statusHarga: data.tampil_harga,
            latitude: data.latitude,
            longitude: data.longitude,
            url360: data.url_360,
            status: data.status
        })
    }

    handleUpload = async (id) => {
        this.props.onSubmit(true, 'Sedang Upload Gambar...')
        let dataUpload = new FormData();
        if(this.state.files.length > 0){
            this.state.files.forEach((image_file) => {
                dataUpload.append('gambar[]', image_file);
            });
            dataUpload.append('idBaliho', id)
            let res = await this.props.uploadImage(dataUpload)
            if(res.status === 'success'){
                this.props.onNotify(true, 'success', 'Berhasil Menyimpan Data dan Berhasil Upload Gambar')
            }else{
                this.props.onNotify(true, 'success', 'Berhasil Menyimpan Data dan Gambar '+res.message)
            }
        }else{
            this.props.onNotify(true, 'success', 'Berhasil Menyimpan Data. Tidak Ada Gambar Yang Di Upload')
        }
    }

    handleSave = async () => {
        let filter = this.props.filter
        let data = new FormData();
        let param = '';

        if(filter !== 'add'){param = 'patch';}
        Object.keys(this.state).map( row => {
            data.append(row, this.state[row])
        })
        
        this.props.onSubmit(true, 'Sedang Menyimpan Data...')
        let res = await this.props.postMedia(data, param)
        if (res.status !== 'success'){
            this.props.onSubmit(false, '')
            this.props.onNotify(true, 'error', 'Gagal Menyimpan Data '+res.message)
        }else{
            await this.handleUpload(res.data.id)
            await this.props.onSubmit(false, '')
            await this.clearField(filter) //redirect or clear field
        }
        
    }

    clearField = (param) => {
        if(param === 'add'){
            this.setState({
                namaMedia: '',lebar: 0,tinggi: 0, orientasi: 'potrait', alamat: '',
                posisi:'Stand Alone', tampilan: '1', alamat: '', hargaClient: '0', deskripsi: '', 
                hargaMarket: 0, hargaMax: 0, statusHarga: 'tidak terlihat', latitude: '',longitude: '',url360: '', files: [], status: 'publish'
            })
            this.addProperti()
        }else{
            this.setState({redirect: true})
        }
    }

    addProperti = async () => {
        if(this.props.utility.dataKategori.length > 0){
            this.setState({
                idKategori: this.props.utility.dataKategori[0].id_kategori
            })
        }
        await this.props.fetchKota()
        this.setState({
            idKota: this.props.utility.dataKota[0].id_kota
        })
    }

    patchProperti = async (param) => {
        let id = this.props.match.params.id;
        await this.props.fetchMediaByID('', id)
        await this.props.fetchImageById(id)
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
        if(filter !== 'add'){
            await this.patchProperti('')
        }else{
            await this.addProperti()
        }
        await this.props.onMounted('Media Iklan')
        
    }

    openDialog = (id, nama) =>{
        this.setState({
            dialogTitle: 'Hapus Data?',
            dialogMessage: 'Apa Anda Yakin Menghapus Gambar '+nama+' ?',
            dialogOpen: true,
            idGambar: id
        })
    }

    closeDialog = () => {
        this.setState({
            dialogOpen: false,
            idGambar: ''
        })
    }

    confirmDialog = async () => {
        let id = this.props.match.params.id;
        this.closeDialog()
        this.props.onSubmit(true, 'Sedang Menyimpan Data...')
        
        let res = await this.props.deleteImage(this.state.idGambar)
        if(res.status === 'success'){
            this.props.onNotify(true, 'success', 'Behasil Menghapus Data ')
            await this.props.fetchImageById(id)
        }else{
            this.props.onNotify(true, 'error', 'Gagal Menghapus Data ')
        }
        this.props.onSubmit(false, '')
    }
    
    render() {
        const { classes } = this.props;
        const {pageProgress, pageLoadingStatus, pageLoading, redirect} = this.props.page;
        const {dataMediaByIdFound, dataImage} = this.props.mediaiklan;
        const {dataMitra} = this.props.mitra;
        const {dataKategori, dataKota} = this.props.utility;
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
            let url = '/dashboard/mediaiklan';
            return <Redirect to={url} />
        }
        return (
            <div>
                <LoadingBar progress={pageProgress} height={3} color='#f11946' />
                <MBreadcumb items={breadcumbItems}/>
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
                                <BasicTextfield name='namaClient' placeholder='Nama Mitra' value={this.state.namaClient} onChange={this.handleChange}/>
                            }
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                                <Combobox label='Jenis Media' name='idKategori' value={this.state.idKategori} onChange={this.handleChange}>
                                        {
                                            dataKategori !== null ?
                                            dataKategori.map( (row, id) => {
                                                return (
                                                    <MenuItem key={id} value={row.id_kategori}>{row.kategori}</MenuItem>
                                                )
                                            } )
                                            : <MenuItem value=''>---</MenuItem>
                                        }
                                </Combobox>
                            </Grid>
                        </Grid>
                        <BasicTextfield placeholder='Nama Media' name='namaMedia' value={this.state.namaMedia} onChange={this.handleChange}/>
                        
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                                <NumberTextfield InputProps={{endAdornment: <InputAdornment position="end">Cm</InputAdornment>}} value={this.state.lebar} onChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({lebar: formattedValue})
                                    }
                                }/>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <NumberTextfield InputProps={{endAdornment: <InputAdornment position="end">Cm</InputAdornment>}} value={this.state.tinggi} onChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({tinggi: formattedValue})
                                    }
                                }/>
                            </Grid>
                        </Grid>
                        
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <Combobox name='orientasi' label='Orientasi' value={this.state.orientasi}
                                    onChange={this.handleChange} >
                                <MenuItem value='potrait' >Potrait</MenuItem>
                                <MenuItem value='landscape' >Landscape</MenuItem>
                            </Combobox>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <Combobox name='kota' label='Kota' value={this.state.idKota}
                                    onChange={this.handleChange} >
                                        {
                                            dataKota !== null ?
                                            dataKota.map( (row, id) => {
                                                return (
                                                    <MenuItem key={id} value={row.id_kota}>{`${row.nama_kota} ( ${row.nama_provinsi} )`}</MenuItem>
                                                )
                                            } )
                                            : <MenuItem value=''>---</MenuItem>
                                        }
                            </Combobox>
                            </Grid>
                        </Grid>
                        <Grid container spacing={2}>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <Combobox name='posisi' label='Posisi' value={this.state.posisi} onChange={this.handleChange} >
                                    <MenuItem value='Stand Alone'>Stand Alone</MenuItem>
                                    <MenuItem value='Attach By Building'>Attach By Building</MenuItem>
                            </Combobox>
                            </Grid>
                            <Grid item xs={12} sm={12} md={12} lg={6}>
                            <Combobox name='tampilan' label='Tampilan Muka' value={this.state.tampilan} onChange={this.handleChange} >
                                <MenuItem value='1'>1 Muka</MenuItem>
                                <MenuItem value='2'>2 Muka</MenuItem>
                            </Combobox>
                            </Grid>
                        </Grid>
                        <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
                                value={this.state.alamat} onChange={this.handleChange}/>
                        <NumberTextfield InputProps={{startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} value={this.state.hargaClient} onChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({hargaClient: formattedValue})
                                    }
                                }/>
                        <TextField name='deskripsi' id="deskripsi" label="Deskripsi" margin="dense" variant="outlined" fullWidth multiline rows="5"
                            value={this.state.deskripsi} onChange={this.handleChange}/>
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
                    <Combobox name='statusHarga' label='Status harga' value={this.state.statusHarga} onChange={this.handleChange} >
                            <MenuItem value='tidak terlihat'>Tidak Terlihat</MenuItem>
                            <MenuItem value='range'>Kisaran</MenuItem>
                            <MenuItem value='satu harga'>Minimum</MenuItem>
                    </Combobox>
                    {this.state.statusHarga !== 'tidak terlihat' ?
                        <Grid container spacing={2}>
                            <Grid item item xs={12} sm={12} md={12} lg={this.state.statusHarga === 'satu harga' ? 12 : 6}>
                            <NumberTextfield label='Harga Minimum' InputProps={{startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} value={this.state.hargaMarket} onChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({hargaMarket: formattedValue})
                                    }
                            }/>
                            </Grid>
                            {this.state.statusHarga === 'range' ? 
                            <Grid item item xs={12} sm={12} md={12} lg={6}>
                                <NumberTextfield label='Harga Maximum' InputProps={{startAdornment: <InputAdornment position="start">Rp.</InputAdornment>}} value={this.state.hargaMax} onChange={
                                    (values) => {
                                        const {formattedValue, value} = values;
                                        this.setState({hargaMax: formattedValue})
                                    }
                                }/>
                            </Grid>
                        : ''}

                    </Grid>
                    :''}
                    
                    
                    <BasicTextfield name='latitude' placeholder='Latitude' onChange={this.handleChange} value={this.state.latitude}/>
                    <BasicTextfield name='longitude' placeholder='Longitude' onChange={this.handleChange} value={this.state.longitude}/>
                    <BasicTextfield name='url360' placeholder='URL 360' onChange={this.handleChange} value={this.state.url360}/>
                    <RadioButton  label='Publikasi' items={radioItems} value={this.state.status} name='status' onChange={this.handleChange}/>
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
                    <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="contained" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={this.handleSave}>
                                Simpan
                            </Button>
                        </Box>
                    </BasicPanelContent>
                </BasicPanel>
                        </Grid>
                    </Grid>

                {this.props.filter === 'patch' ? 
                    <React.Fragment>
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={12} lg={12}>
                            <BasicPanel>
                            <BasicPanelHeader color='#9129AC'>
                                <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Gambar Media Tersedia</Box>
                            </BasicPanelHeader>
                            <BasicPanelContent>
                            <Grid container spacing={1}>
                                
                                {
                                    dataImage.length > 0 ?
                                    dataImage.map( (row, i) => {
                                        return (
                                            <Grid key={i} item xs={12} sm={12} md={4} lg={2}>
                                            <Card >
                                                <CardActionArea>
                                                <CardMedia
                                                    className={classes.media}
                                                    image={`/assets/thumbnails/${row.url_foto}`}
                                                    title={row.url_foto}
                                                    />
                                                </CardActionArea>
                                                <CardActions>
                                                    <IconButton size='small' color="primary" 
                                                                classes={{
                                                                    colorPrimary: classes.iconButton
                                                                }}
                                                                onClick={() => this.openDialog(row.id_foto, row.url_foto)}
                                                    >
                                                        <DeleteIcon/>
                                                    </IconButton >
                                                </CardActions>
                                            </Card>
                                            </Grid>
                                        )
                                    }) :
                                    <Box display='flex' justifyContent='center'>
                                        <h4>Tidak Ada Media</h4>
                                    </Box>
                                }
                                
                                
                            </Grid>
                            </BasicPanelContent>
                            </BasicPanel>
                        </Grid>
                    </Grid>
                    </React.Fragment>
                :
                ''
                }    
                </Fade>
                <Question title={this.state.dialogTitle} message={this.state.dialogMessage} open={this.state.dialogOpen} onClose={this.closeDialog} onConfirm={this.confirmDialog}/>
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
        fetchImageById: bindActionCreators(fetchImageById, dispatch),
        fetchMitra: bindActionCreators(fetchMitra, dispatch),
        fetchKategori: bindActionCreators(fetchKategori, dispatch),
        fetchKota: bindActionCreators(fetchKota, dispatch),
        prepareMount: bindActionCreators(prepareMount, dispatch),
        onMounted: bindActionCreators(onMounted, dispatch),
        pageOnProgress: bindActionCreators(pageOnProgress, dispatch),
        onSubmit: bindActionCreators(onSubmit, dispatch),
        onNotify: bindActionCreators(onNotify, dispatch),
        postMedia: bindActionCreators(postMedia, dispatch),
        uploadImage: bindActionCreators(uploadImage, dispatch),
        deleteImage: bindActionCreators(deleteImage, dispatch),
    }
}

export default compose(
    withStyles(useStyles),
    connect(mapStateToProps, mapDispatcToProps)
    )(PageConfirmMedia);

