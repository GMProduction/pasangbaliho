// import React, { Component } from 'react';
// import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../../components/Material-UI/Panel/Basicpanel/BasicPanel';
// import Grid from '@material-ui/core/Grid';
// import Box from '@material-ui/core/Box';
// import TextField from '@material-ui/core/TextField';
// import FormControl from '@material-ui/core/FormControl';
// import InputLabel from '@material-ui/core/InputLabel';
// import MenuItem from '@material-ui/core/MenuItem';
// import Select from '@material-ui/core/Select';
// import Icon from '@material-ui/core/Icon';
// import {connect} from 'react-redux';
// import { bindActionCreators } from 'redux';
// import {fetchKategori, fetchProvinsi, fetchKota, formValue} from '../../../Actions/MediaIklanActions';

// const style = {
//     resize: {
//         fontSize: 14, 
//         fontFamily: 'Roboto Regular'
//     },
//     adornment:{
//         marginRight: '-12px'
//     },
// }

// export class InformasiMitra extends Component {
//     constructor(props) {
//         super(props);
//         this.state = {
//             idClient : '',namaClient : '',idKategori : '',namaMedia: '',lebar: '0',tinggi: '0',alamat: '',idProvinsi: '', idKota: '',
//             venue:'', alamat: '', hargaClient: '0', deskripsi: '', 
//         }
//     }

//     handleChange = async (e) => {
//         let value = e.target.value;
//         let name = e.target.name;
//         this.setState({
//             [e.target.name]: e.target.value
//         })
//         if (e.target.name === 'idProvinsi') {
//             this.setState({
//                 idKota: ''
//             })
//             await this.props.fetchKota(e.target.value)
//             this.setState({
//                 idKota: this.props.mediaiklan.dataKota[0].id_kota
//             })
//         }
//         this.props.formValue(name, value);
//     }

//     initData = async (data) => {
//         if (data !== null) {
//             this.setState({
//                 idClient: data.id_client,
//                 namaClient: data.nama,
//                 idKategori: data.id_kategori,
//                 namaMedia: data.nama_baliho,
//                 lebar: data.lebar,
//                 tinggi: data.tinggi,
//                 idProvinsi: data.id_provinsi,
//                 idKota: data.id_kota,
//                 alamat: data.alamat,
//                 venue: data.venue,
//                 hargaClient: data.harga_client,
//                 deskripsi: data.deskripsi
//             })
//         }
//     }
    
//     async componentDidMount () {
//         let dataMediaById = this.props.dataMediaById;
//         let idProvinsi = this.props.dataMediaById.id_provinsi;
//         await this.props.fetchKategori()
//         await this.props.fetchProvinsi()
//         await this.props.fetchKota(idProvinsi)
//         await this.initData(dataMediaById)
//     }


//     render() {
//         // console.log(this.props.mediaiklan.formMedia);
//         const {dataKategori, dataProvinsi, dataKota} = this.props.mediaiklan
//         return (
//             <div>
//                 <BasicPanel>
//                     <BasicPanelHeader color='#9129AC'>
//                         <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Mitra Media</Box>
//                     </BasicPanelHeader>
//                     <BasicPanelContent>
//                         <Grid container spacing={2}>
//                             <Grid item xs={12} sm={12} md={12} lg={6}>
//                                 <TextField disabled name='namaClient' id="namaClient" label="Nama mitra" margin="dense" variant="outlined" fullWidth
//                                     InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaClient} onChange={this.handleChange}/>
//                             </Grid>
//                             <Grid item xs={12} sm={12} md={12} lg={6}>
//                                 <FormControl variant='outlined' margin='dense' fullWidth>
//                                     <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
//                                         Jenis Media
//                                     </InputLabel>
//                                     <Select
//                                         id="demo-simple-select-outlined"
//                                         value={this.state.idKategori}
//                                         onChange={this.handleChange}
//                                         labelWidth={80}
//                                         style={style.resize}
//                                         name='idKategori'
//                                         >
//                                         {
//                                             dataKategori !== null ?
//                                             dataKategori.map( (row, id) => {
//                                                 return (
//                                                     <MenuItem key={id} value={row.id_kategori} style={style.resize}>{row.kategori}</MenuItem>
//                                                 )
//                                             } )
//                                             : <MenuItem value='' style={style.resize}>---</MenuItem>
//                                         }
//                                     </Select>
//                                 </FormControl>
//                             </Grid>
//                         </Grid>
//                         <TextField name='namaMedia' id="namaMedia" label="Nama Media" margin="dense" variant="outlined" fullWidth 
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaMedia} onChange={this.handleChange}/>
//                         <Grid container spacing={2}>
//                             <Grid item xs={12} sm={12} md={12} lg={6}>
//                             <TextField name='lebar' id="lebar" label="Lebar" margin="dense" variant="outlined" fullWidth type='number'
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.lebar} onChange={this.handleChange}/>
//                             </Grid>
//                             <Grid item xs={12} sm={12} md={12} lg={6}>
//                             <TextField name='tinggi' id="tinggi" label="Tinggi" margin="dense" variant="outlined" fullWidth type='number'
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.tinggi} onChange={this.handleChange}/>
//                             </Grid>
//                         </Grid>
//                         <Grid container spacing={2}>
//                             <Grid item xs={12} sm={12} md={12} lg={6}>
//                             <FormControl variant='outlined' margin='dense' fullWidth>
//                                     <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
//                                         Provinsi
//                                     </InputLabel>
//                                     <Select
//                                         id="demo-simple-select-outlined"
//                                         value={this.state.idProvinsi}
//                                         onChange={this.handleChange}
//                                         labelWidth={80}
//                                         style={style.resize}
//                                         name='idProvinsi'
//                                         >
//                                         {
//                                             dataProvinsi !== null ?
//                                             dataProvinsi.map( (row, id) => {
//                                                 return (
//                                                     <MenuItem key={id} value={row.id_provinsi} style={style.resize}>{row.nama_provinsi}</MenuItem>
//                                                 )
//                                             } )
//                                             : <MenuItem value='' style={style.resize}>---</MenuItem>
//                                         }
//                                     </Select>
//                                 </FormControl>
//                             </Grid>
//                             <Grid item xs={12} sm={12} md={12} lg={6}>
//                             <FormControl variant='outlined' margin='dense' fullWidth>
//                                     <InputLabel id="demo-simple-select-outlined-label" style={style.resize}>
//                                         Kota
//                                     </InputLabel>
//                                     <Select
//                                         id="demo-simple-select-outlined"
//                                         value={this.state.idKota}
//                                         onChange={this.handleChange}
//                                         labelWidth={80}
//                                         style={style.resize}
//                                         name='idKota'
//                                         >
//                                         {
//                                             dataKota !== null ?
//                                             dataKota.map( (row, id) => {
//                                                 return (
//                                                     <MenuItem key={id} value={row.id_kota} style={style.resize}>{row.nama_kota}</MenuItem>
//                                                 )
//                                             } )
//                                             : <MenuItem value='' style={style.resize}>---</MenuItem>
//                                         }
//                                     </Select>
//                                 </FormControl>
//                             </Grid>
//                         </Grid>
//                         <TextField name='venue' id="venue" label="Venue" margin="dense" variant="outlined" fullWidth
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.venue} onChange={this.handleChange}/>
//                         <TextField name='alamat' id="alamat" label="Alamat" margin="dense" variant="outlined" fullWidth multiline rows="3"
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.alamat} onChange={this.handleChange}/>
//                         <TextField name='hargaClient' id="hargaClient" label="Harga Mitra" margin="dense" variant="outlined" fullWidth type='number'
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.hargaClient} onChange={this.handleChange}/>
//                         <TextField name='deskripsi' id="deskripsi" label="deskripsi" margin="dense" variant="outlined" fullWidth multiline rows="5"
//                                 InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.deskripsi} onChange={this.handleChange}/>
//                     </BasicPanelContent>
//                 </BasicPanel>
//             </div>
//         );
//     }
// }

// function mapStateToProps(state) {
//     return{
//         mediaiklan: state.MediaIklanReducer
//     }
// }

// function mapDispatcToProps (dispatch) {
//     return {
//         formValue: bindActionCreators(formValue, dispatch),
//         fetchKategori: bindActionCreators(fetchKategori, dispatch),
//         fetchProvinsi: bindActionCreators(fetchProvinsi, dispatch),
//         fetchKota: bindActionCreators(fetchKota, dispatch),
//     }
// }

// export default connect(mapStateToProps, mapDispatcToProps)(InformasiMitra);
