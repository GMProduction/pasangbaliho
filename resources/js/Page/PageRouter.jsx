import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import Testing from './Testing';
import Dashboard from '../page/Dashboard/Dashboard';
import PageMedia from './MediaIklan/PageMedia';
import PageConfirmMedia from './MediaIklan/PageConfirmMedia';
import PageListMedia from './MediaIklan/PageListMedia';

import PageNegosiasi from './Negosiasi/PageNegosiasi';
import PageListNego from './Negosiasi/PageListNego';
import PageBeriHarga from './Negosiasi/PageBeriHarga';

import PageMitra from './Mitra/PageMitra';
import PageAddMitra from './Mitra/PageAddMitra';
import PageAdvertiser from './Advertiser/PageAdvertiser';
import PageAddAdvertiser from './Advertiser/PageAddAdvertiser';
import Test from './Auth/Test'
import PagePembayaran from './Pembayaran/PagePembayaran';
import PageListPembayaran from './Pembayaran/PageListPembayaran';
import PageConfirmPayment from './Pembayaran/PageConfirmPayment';
import pageManualPayment from './Pembayaran/pageManualPayment';
import PagePaymentConfirm from './Pembayaran/PagePaymentConfirm';

import PageListMateri from './Materi/PageListMateri';
import PageConfirmMateri from './Materi/PageConfirmMateri';

import Perlengkapan from './Perlengkapan/Perlengkapan';
import PageLaporan from './Laporan/PageLaporan';
import PageLaporanTransaksi from './Laporan/PageLaporanTransaksi';

export class PageRouter extends Component {
    render() {
        return (
            <div>
                    <Route exact path='/dashboard' component={Dashboard}/>

                    <Route exact path='/dashboard/perlengkapan/mitra' component={PageMitra}/>
                    <Route exact path='/dashboard/perlengkapan/mitra/add' render={(props) => <PageAddMitra {...props} filter='add'/>}/>
                    <Route exact path='/dashboard/perlengkapan/mitra/edit/:id' render={(props) => <PageAddMitra {...props} filter='edit'/>}/>
                    
                    <Route exact path='/dashboard/perlengkapan/advertiser' component={PageAdvertiser}/>
                    <Route exact path='/dashboard/perlengkapan/advertiser/add' render={(props) => <PageAddAdvertiser {...props} filter='add'/>}/>
                    <Route exact path='/dashboard/perlengkapan/advertiser/edit/:id' render={(props) => <PageAddAdvertiser {...props} filter='edit'/>}/>

                    <Route exact path='/dashboard/mediaiklan' component={PageMedia}/>
                    <Route exact path='/dashboard/mediaiklan/permintaan' render={(props) => <PageListMedia {...props} filter='pending'/>} />
                    <Route exact path='/dashboard/mediaiklan/publish' render={(props) => <PageListMedia {...props} filter='publish'/>} />
                    <Route exact path='/dashboard/mediaiklan/block' render={(props) => <PageListMedia {...props} filter='block'/>} />
                    <Route exact path='/dashboard/mediaiklan/all' render={(props) => <PageListMedia {...props} filter='all'/>} />
                    <Route exact path='/dashboard/mediaiklan/permintaan/:id' render={(props) => <PageConfirmMedia {...props} filter='pending'/>}/>
                    <Route exact path='/dashboard/mediaiklan/detail/:id' render={(props) => <PageConfirmMedia {...props} filter='update'/>}/>
                    <Route exact path='/dashboard/mediaiklan/form' render={(props) => <PageConfirmMedia {...props} filter='add'/>}/>
                    
                    
                    <Route exact path='/dashboard/negosiasi' component={PageNegosiasi}/>
                    <Route exact path='/dashboard/negosiasi/permintaan' render={(props) => <PageListNego {...props} filter='permintaan'/>}/>
                    <Route exact path='/dashboard/negosiasi/negoharga' render={(props) => <PageListNego {...props} filter='negoharga'/>}/>
                    <Route exact path='/dashboard/negosiasi/permintaan/:id' render={(props) => <PageBeriHarga {...props} filter='permintaan'/>}/>
                    <Route exact path='/dashboard/negosiasi/negoharga/:id' render={(props) => <PageBeriHarga {...props} filter='negoharga'/>}/>

                    <Route exact path='/dashboard/pembayaran' component={PagePembayaran}/>
                    <Route exact path='/dashboard/pembayaran/list' component={PageListPembayaran}/>
                    <Route exact path='/dashboard/pembayaran/list/:id' component={PageConfirmPayment}/>
                    <Route exact path='/dashboard/pembayaran/manual' component={pageManualPayment}/>
                    <Route exact path='/dashboard/pembayaran/manual/:id' component={PagePaymentConfirm}/>

                    <Route exact path='/dashboard/materi' component={PageListMateri}/>
                    <Route exact path='/dashboard/materi/:id' component={PageConfirmMateri}/>
                    
                    <Route exact path='/dashboard/perlengkapan' component={Perlengkapan}/>

                    <Route exact path='/dashboard/berita' component={Test}/>

                    <Route exact path='/dashboard/laporan' component={PageLaporan}/>
                    <Route exact path='/dashboard/laporan/proses' component={PageLaporanTransaksi}/>

            </div>
        );
    }
}

export default PageRouter;
