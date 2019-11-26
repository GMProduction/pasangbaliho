import React, { Component } from 'react';
import Fade from 'react-reveal/Fade';
import LoadingBar  from 'react-top-loading-bar';
import StatusBox from './Component/StatusBox';
import Grid from '@material-ui/core/Grid';
import PermintaanHarga from './Component/PermintaanHarga';
import { loadPermintaan } from '../../Controller/DashboardControll';

export class Dashboard extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
            isLoading: true,
            dataPermintaan: [],
            dataPermintaanMedia: [],
            databaliho: [],
            jumlahBaliho: 0
        }
    }

    initData = async () => {
        this.setState({
            loadingBarProgress: 30,
        })
        let permintaanHarga = await loadPermintaan();
        this.setState({
            loadingBarProgress: 100,
            dataPermintaan: permintaanHarga,
            isLoading: false
        })
    }

    componentDidMount () {
        this.initData()
    }

    render() {
        return (
            <div>
                <LoadingBar
                    progress={this.state.loadingBarProgress}
                    height={3}
                    color='#f11946'
                   />
                   <Fade right><StatusBox jumlahBaliho={this.state.jumlahBaliho}/></Fade>
                {
                    !this.state.isLoading ? 
                <Fade bottom>
                    
                    <Grid container spacing={3} style={{marginTop: '10px'}}>
                        <Grid item xs={12} sm={12} md={7} lg={7}>
                            <PermintaanHarga data={this.state.dataPermintaan}/>
                        </Grid>
                        <Grid item xs={12} sm={12} md={5} lg={5}>
                            {/* <RecentBaliho data={this.state.databaliho}/> */}
                        </Grid>
                    </Grid>
                    <Grid container spacing={3} style={{marginTop: '10px'}}>
                        <Grid item xs={12} sm={12} md={12} lg={12}>
                            {/* <PermintaanBaliho data={this.state.dataPermintaanMedia}/> */}
                        </Grid>
                        
                    </Grid>
                </Fade> : ''
                }
            </div>
        );
    }
}

export default Dashboard;
