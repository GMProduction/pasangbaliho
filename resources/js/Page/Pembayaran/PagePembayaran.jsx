import React, { Component } from 'react'
import Grid from '@material-ui/core/Grid';
import PanelMenu from '../../components/Material-UI/Panel/PanelMenu/PanelMenu';
import Fade from 'react-reveal/Fade';
import BCPageMediaIklan from '../../components/Material-UI/Breadcumbs/BCPageMediaIklan';
import LoadingBar  from 'react-top-loading-bar';

export class PagePembayaran extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loadingBarProgress: 0,
        }
    }

    componentDidMount(){
        this.setState({
            loadingBarProgress: 100
        })
    }

    render(){
        return(
            <div>
                <LoadingBar progress={this.state.loadingBarProgress} height={3} color='#f11946' />
                <Fade right>
                <Grid container justify='center'>
                    <Grid item xs={12} sm={12} md={12} lg={12} style={{marginBottom: '25px'}}>
                        <Grid container spacing={3}>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/dashboard/pembayaran/manual'
                                    color='#20C1D5'
                                    icon='monetization_on'
                                    title={`Manual Transfer`}
                                    subTitle='Pembayaran Melalui Proses Manual Transfer.'
                                />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6} lg={6}>
                                <PanelMenu
                                    link='/dashboard/pembayaran/gateway'
                                    color='#FC9007'
                                    icon='payment'
                                    title='Payment Gateway'
                                    subTitle='Pembayaran Melalui Payment Gateway iPay88.'
                                />
                            </Grid>
                        </Grid>
                    </Grid>
                </Grid>
                </Fade>
            </div>
        );
    }
}

export default PagePembayaran;