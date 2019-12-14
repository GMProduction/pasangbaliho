import React, { Component } from 'react';
import Grid from '@material-ui/core/Grid';
import PanelMenu from '../../components/Material-UI/Panel/PanelMenu/PanelMenu';
import Fade from 'react-reveal/Fade';
import BCPageMediaIklan from '../../components/Material-UI/Breadcumbs/BCPageMediaIklan';
import LoadingBar  from 'react-top-loading-bar';


export class PageMedia extends Component {
    constructor(props) {
        super(props);
        this.state = {
            dataPermintaan: [],
            dataPublikasi: [],
            dataBlokir: [],
            dataSemua: [],
            loadingBarProgress: 0,
        }
    }

    componentDidMount(){
        this.setState({
            loadingBarProgress: 100
        })
    }

    render() {
        return (
            <div>
                <LoadingBar progress={this.state.loadingBarProgress} height={3} color='#f11946' />
                <BCPageMediaIklan/>
                <Fade right>
                <Grid container justify='center'>
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '25px'}}>
                        <Grid container spacing={3}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/mediaiklan/permintaan'
                                    color='#20C1D5'
                                    icon='local_offer'
                                    title={`Permintaan Penambahan Media Iklan (${this.state.dataPermintaan.length})`}
                                    subTitle='Permintaan Penambahan Media Iklan Yang di tambahkan oleh Mitra Media.'
                                />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/mediaiklan/form'
                                    color='#FC9007'
                                    icon='note_add'
                                    title='Penambahan Media Iklan'
                                    subTitle='Penambahan Media Iklan Yang Di Tambahkan oleh Admin.'
                                />
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '25px'}}>
                        <Grid container spacing={3}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/mediaiklan/publish'
                                color='#56AE5A'
                                icon='filter_list'
                                title={`Daftar Media Iklan Terpublikasi (${this.state.dataPublikasi.length})`}
                                subTitle='Daftar Media Iklan Yang Di Publikasikan.'
                            />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                            <PanelMenu
                                link='/mediaiklan/block'
                                color='#EB4A47'
                                icon='block'
                                title={`Daftar Media Iklan Terblokir (${this.state.dataBlokir.length})`}
                                subTitle='Daftar Media Iklan Yang Di Blokir Oleh Admin Atau Tidak Di Publikasikan.'
                            />
                            </Grid>
                        </Grid>
                    </Grid>
                    
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '15px'}}>
                        <PanelMenu
                                link='/mediaiklan/daftar'
                                color='#9128AC'
                                icon='list'
                                title={`Daftar Semua Media iklan (${this.state.dataSemua.length})`}
                                subTitle='Daftar Semua Media Iklan Yang Di Publikasikan Atau Tidak Di Publikasikan.'
                        />
                    </Grid>
                </Grid>
                </Fade>
            </div>
        );
    }
}

export default PageMedia;
