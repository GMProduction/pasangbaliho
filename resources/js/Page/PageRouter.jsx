import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import Dashboard from '../page/Dashboard/Dashboard';
import PageMedia from './MediaIklan/PageMedia';
import PagePermintaanMedia from './MediaIklan/PagePermintaanMedia';
import PagePersetujuanMedia from './MediaIklan/PagePersetujuanMedia';
import PageMediaPublik from './MediaIklan/PageMediaPublik';
import PageMediaBlock from './MediaIklan/PageMediaBlock';
import PageListMedia from './MediaIklan/PageListMedia';
import PageAddMedia from './MediaIklan/PageAddMedia';
import PageNegosiasi from './Negosiasi/PageNegosiasi';
import PagePermintaanHarga from './Negosiasi/PagePermintaanHarga';
import PageBeriHarga from './Negosiasi/PageBeriHarga';
import PageNegoHarga from './Negosiasi/PageNegoHarga';
import PageHargaDeal from './Negosiasi/PageHargaDeal';
import PageNegoMateri from './Negosiasi/PageNegoMateri';
import PageNegoSelesai from './Negosiasi/PageNegoSelesai';
import PageMitra from './Mitra/PageMitra';
import PageAdvertiser from './Advertiser/PageAdvertiser';

export class PageRouter extends Component {
    render() {
        return (
            <div>
                <Switch>
                    <Route exact path='/admin' component={Dashboard}/>

                    <Route exact path='/admin/mediaiklan' component={PageMedia}/>
                    <Route exact path='/admin/mediaiklan/list/:filter' render={(props) => <PageListMedia {...props}/>} />
                    <Route exact path='/admin/mediaiklan/permintaan/:id' component={PagePersetujuanMedia}/>
                    <Route exact path='/admin/mediaiklan/form' component={PageAddMedia}/>
                    
                    <Route exact path='/admin/mitra' component={PageMitra}/>
                    <Route exact path='/admin/advertiser' component={PageAdvertiser}/>
                    
                    <Route exact path='/admin/negosiasi' component={PageNegosiasi}/>
                    <Route exact path='/admin/negosiasi/permintaan' component={PagePermintaanHarga}/>
                    <Route exact path='/admin/negosiasi/permintaan/:id' component={PageBeriHarga}/>
                    <Route exact path='/admin/negosiasi/negoharga' component={PageNegoHarga}/>
                    <Route exact path='/admin/negosiasi/negoharga/:id' component={PageHargaDeal}/>
                    <Route exact path='/admin/negosiasi/negomateri' component={PageNegoMateri}/>
                    <Route exact path='/admin/negosiasi/negomateri/:id' component={PageNegoSelesai}/>

                </Switch>
            </div>
        );
    }
}

export default PageRouter;
