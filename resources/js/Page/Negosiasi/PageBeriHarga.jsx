import React, { Component } from 'react';
import Breadcrumbs from '@material-ui/core/Breadcrumbs';
import { NavLink } from 'react-router-dom';
import Icon from '@material-ui/core/Icon';
import Paper from '@material-ui/core/Paper';
import Box from '@material-ui/core/Box';
import {withStyles} from '@material-ui/core';
import BasicPanel, {BasicPanelHeader, BasicPanelContent} from '../../components/Material-UI/Panel/Basicpanel/BasicPanel';
import BasicTable from '../../components/Material-UI/Table/BasicTable';
import TextField from '@material-ui/core/TextField';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import { breadcumbStyle } from '../../Style/Breadcumb';
import { columnsPermintaan } from './Properties/Properties';
import Grid from '@material-ui/core/Grid';
import { loadPermintaanHargaById, setHarga } from '../../Controller/NegosiasiControll';
import { Divider } from '@material-ui/core';
import Button from '@material-ui/core/Button';

const style = {
    resize2: {
        fontSize: 14, 
        fontFamily: 'Roboto Light',
        height: 0
    },
    resize: {
        fontSize: 14, 
        fontFamily: 'Roboto Light',
    },
    resize3: {
        fontSize: 14, 
        fontFamily: 'Roboto Light',
        height: 45
    }
}

export class PageBeriHarga extends Component {

    constructor(props) {
        super(props);
        this.state = {
            namaadvertiser: '',
            tanggalAwal: '',
            tanggalAkhir: '',
            namaBaliho: '',
            kategori: '',
            usedon: [],
            hargaDeal: 0,
        }
    }

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    update = async (status) => {
        let id = this.props.match.params.id;
        let dataUpdate = {
            hargaPenawaran: this.state.hargaDeal,
            idtransaksi: id
        }
        let res = await setHarga(dataUpdate);
        console.log(res);
    }

    initData = async () => {
        let id = this.props.match.params.id;
        let data = await loadPermintaanHargaById(id);
        let idbaliho = data.idBaliho;
        this.setState({
            namaadvertiser: data.namaAdvertiser,
            tanggalAwal: data.tanggal_awal,
            tanggalAkhir: data.tanggal_akhir,
            namaBaliho: data.namaBaliho,
            kategori: data.kategori,
            // usedon: dataused
        })
    }



    componentDidMount () {
        this.initData();
    }
    render() {
        const { classes } = this.props;
        return (
            <div>
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
                            color="inherit" to="/admin/negosiasi"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>question_answer</Icon>
                                Negosiasi
                            </NavLink>
                            <NavLink
                            color="inherit" to="/admin/negosiasi/permintaan"
                            className={classes.link}
                            >
                            <Icon className={classes.icon}>local_offer</Icon>
                                Permintaan
                            </NavLink>
                        <Box display='flex' alignItems='center' style={{color: '#555555', fontFamily: 'Roboto Light', fontSize: '14px'}}>
                            <Icon className={classes.icon}>attach_money</Icon>
                                Pemberian harga
                            </Box>
                    </Breadcrumbs>
                </Paper>
                <Grid container spacing={2}>
                <Grid item xs={12} sm={12} md={12} lg={6}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Permintaan Harga</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <TextField name='namaadvertiser' id="namaadvertiser" label="Nama Advertiser" margin="dense" variant="outlined" fullWidth 
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaadvertiser} />
                        <TextField name='tanggalsewa' id="tanggalsewa" label="Tanggal Penyewaan" margin="dense" variant="outlined" fullWidth 
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={`${this.state.tanggalAwal} - ${this.state.tanggalAkhir}`} />
                        </BasicPanelContent>
                    </BasicPanel>
                </Grid>
                <Grid item xs={12} sm={12} md={12} lg={6}>
                    <BasicPanel>
                        <BasicPanelHeader color='#9129AC'>
                        <Box flexGrow={1} display="flex" alignItems="center"><Icon fontSize='inherit'>face</Icon>&nbsp; Informasi Ketersediaan Media</Box>
                        </BasicPanelHeader>
                        <BasicPanelContent>
                        <TextField name='kategori' id="kategori" label="Jenis Media" margin="dense" variant="outlined" fullWidth 
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.kategori} />
                        <TextField name='namaBaliho' id="namaBaliho" label="Nama Media" margin="dense" variant="outlined" fullWidth 
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.namaBaliho} />
                        <Box fontSize={20}>Baliho Ini Tersewa Pada Tanggal :</Box>
                        {
                            this.state.usedon.length > 0 ?
                        this.state.usedon.map((row, id) => {
                            return (
                                <Box key={id}>{`- ${row.tanggal_awal} s/d ${row.tanggal_akhir}`}</Box>
                            )
                        }) : 
                            <Box display='flex' fontSize={14} justifyContent='center'>Tidak Ada Penyewa</Box>
                        }
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <TextField type='number' name='hargaDeal' id="hargaDeal" label="Harga yang Di Tawarkan" margin="dense" variant="outlined" fullWidth 
                                InputProps={{style: style.resize}} InputLabelProps={{style: style.resize}} value={this.state.hargaDeal} onChange={this.handleChange.bind(this)}/>
                        
                        <Divider style={{marginTop: '15px', marginBottom: '15px'}}/>
                        <Box display="flex" justifyContent='flex-end' alignItems="center">
                            <Button variant="contained" color="secondary" startIcon={<Icon>close</Icon>} onClick={() => this.update('tolak')}>
                                Tolak
                            </Button>
                            <Button variant="outlined" color="primary" style={{marginLeft: '10px'}} startIcon={<Icon>check</Icon>} onClick={() => this.update('terima')}>
                                Terima
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

export default withStyles(breadcumbStyle)(PageBeriHarga);
