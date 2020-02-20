import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import Dashboard from '../page/Dashboard/Dashboard';
import PageMedia from './MediaIklan/PageMedia';
import PageConfirmMedia from './MediaIklan/PageConfirmMedia';
import PageListMedia from './MediaIklan/PageListMedia';

import PageNegosiasi from './Negosiasi/PageNegosiasi';
import PageListNego from './Negosiasi/PageListNego';
import PageBeriHarga from './Negosiasi/PageBeriHarga';

import PageMitra from './Mitra/PageMitra';
import PageRequestMitra from './Mitra/PageRequestMitra';
import PageConfirmMitra from './Mitra/PageConfirmMitra';
import PageAddMitra from './Mitra/PageAddMitra';
import PageAdvertiser from './Advertiser/PageAdvertiser';
import PageAddAdvertiser from './Advertiser/PageAddAdvertiser';
import PagePembayaran from './Pembayaran/PagePembayaran';
import PageListPembayaran from './Pembayaran/PageListPembayaran';
import PageConfirmPayment from './Pembayaran/PageConfirmPayment';
import pageManualPayment from './Pembayaran/pageManualPayment';
import PageManualConfirm from './Pembayaran/PageManualConfirm';

import News from './News/News';
import NewsForm from './News/NewsForm';


import PageListMateri from './Materi/PageListMateri';
import PageConfirmMateri from './Materi/PageConfirmMateri';

import Perlengkapan from './Perlengkapan/Perlengkapan';
import PageLaporan from './Laporan/PageLaporan';
import PageLaporanTransaksi from './Laporan/PageLaporanTransaksi';
import PageNotFound from '../components/Material-UI/PageInfo/PageNotFound'
import PageForbidden from '../components/Material-UI/PageInfo/PageForbidden'
import Cookies from 'js-cookie'


const AdminRoute = ({role, component: Component, ...rest}) => {
    
    return(
        <Route
            {...rest}
            render = {
                props => role === 'admin' ? 
                <Component  {...props} {...rest}/>
                :
                (<PageForbidden/>)
            }

        />
    );
}

const RedaksiRoute = ({role, component: Component, ...rest}) => {
    return(
        <Route
            {...rest}
            render = {
                props => role === 'redaksi' ? 
                <Component  {...props} {...rest}/>
                :
                (<PageForbidden/>)
            }
        />
    );
}

const MarketingRoute = ({role, component: Component, ...rest}) => {
    return(
        <Route
            {...rest}
            render = {
                props => role === 'marketing' ?
                <Component  {...props} {...rest}/>
                :
                (<PageForbidden/>)
            }
        />
    );
}

export class PageRouter extends Component {
    
    constructor(props) {
        super(props);
    }

    
    render() {
        const user = JSON.parse(Cookies.get('user'));
        const role = user.role;
        return (
            <div >
                <Switch>
                    <Route exact path='/dashboard' render={ props => <Dashboard {...props} role={role}/>}/>

                    <AdminRoute component={PageMitra} exact path='/dashboard/perlengkapan/mitra' role={role}/>
                    <AdminRoute component={PageRequestMitra} exact path='/dashboard/perlengkapan/requestmitra' role={role}/>
                    <AdminRoute component={PageConfirmMitra} exact path='/dashboard/perlengkapan/requestmitra/:id' role={role}/>
                    <AdminRoute component={PageAddMitra} exact path='/dashboard/perlengkapan/mitra/add' role={role} filter='add'/>
                    <AdminRoute component={PageAddMitra} exact path='/dashboard/perlengkapan/mitra/edit/:id' role={role} filter='edit'/>
                    
                    <AdminRoute component={PageAdvertiser} exact path='/dashboard/perlengkapan/advertiser' role={role} />
                    <AdminRoute component={PageAddAdvertiser} exact path='/dashboard/perlengkapan/advertiser/add' role={role} filter='add'/>
                    <AdminRoute component={PageAddAdvertiser} exact path='/dashboard/perlengkapan/advertiser/edit/:id' role={role} filter='edit'/>
                    
                    <AdminRoute component={PageMedia} exact path='/dashboard/mediaiklan' role={role}/>
                    <AdminRoute component={PageListMedia} exact path='/dashboard/mediaiklan/permintaan' role={role} filter='pending'/>
                    <AdminRoute component={PageListMedia} exact path='/dashboard/mediaiklan/publish' role={role} filter='publish'/>
                    <AdminRoute component={PageListMedia} exact path='/dashboard/mediaiklan/block' role={role} filter='block'/>
                    <AdminRoute component={PageListMedia} exact path='/dashboard/mediaiklan/all' role={role} filter='all'/>
                    <AdminRoute component={PageConfirmMedia} exact path='/dashboard/mediaiklan/permintaan/:id' role={role} filter='pending'/>
                    <AdminRoute component={PageConfirmMedia} exact path='/dashboard/mediaiklan/detail/:id' role={role} filter='patch'/>
                    <AdminRoute component={PageConfirmMedia} exact path='/dashboard/mediaiklan/form' role={role} filter='add'/>
                    
                    <AdminRoute component={PageNegosiasi} exact path='/dashboard/negosiasi' role={role}/>
                    <AdminRoute component={PageListNego} exact path='/dashboard/negosiasi/permintaan' role={role} filter='permintaan'/>
                    <AdminRoute component={PageListNego} exact path='/dashboard/negosiasi/negoharga' role={role} filter='negoharga'/>
                    <AdminRoute component={PageBeriHarga} exact path='/dashboard/negosiasi/permintaan/:id' role={role} filter='permintaan'/>
                    <AdminRoute component={PageBeriHarga} exact path='/dashboard/negosiasi/negoharga/:id' role={role} filter='negoharga'/>
                    
                    <AdminRoute component={PagePembayaran} exact path='/dashboard/pembayaran' role={role}/>
                    <AdminRoute component={PageListPembayaran} exact path='/dashboard/pembayaran/list' role={role}/>
                    <AdminRoute component={PageConfirmPayment} exact path='/dashboard/pembayaran/list/:id' role={role}/>
                    <AdminRoute component={pageManualPayment} exact path='/dashboard/pembayaran/manual' role={role}/>
                    <AdminRoute component={PageManualConfirm} exact path='/dashboard/pembayaran/manual/:id' role={role}/>
                    
                    <AdminRoute component={PageListMateri} exact path='/dashboard/materi' role={role}/>
                    <AdminRoute component={PageConfirmMateri} exact path='/dashboard/materi/:id' role={role}/>
                    
                    <AdminRoute component={Perlengkapan} exact path='/dashboard/perlengkapan' role={role} />
                    <RedaksiRoute component={News} exact path='/dashboard/berita' role={role} />
                    <RedaksiRoute component={NewsForm} exact path='/dashboard/berita/add' role={role} />

                    <Route exact path='/dashboard/laporan' component={PageLaporan} />
                    <Route exact path='/dashboard/laporan/proses' component={PageLaporanTransaksi} />
                    <Route component={PageNotFound}/>
                </Switch>
            </div>
        );
    }
}

export default PageRouter;
