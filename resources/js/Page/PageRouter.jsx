import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import Dashboard from '../page/Dashboard/Dashboard';
import PageMedia from './MediaIklan/PageMedia';
import PagePermintaanMedia from './MediaIklan/PagePermintaanMedia';
import PagePersetujuanMedia from './MediaIklan/PagePersetujuanMedia';
import PageMediaPublik from './MediaIklan/PageMediaPublik';
import PageMediaBlock from './MediaIklan/PageMediaBlock';
import PageAllMedia from './MediaIklan/PageAllMedia';
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
                    <Route exact path='/admin/mediaiklan/permintaan' component={PagePermintaanMedia}/>
                    <Route exact path='/admin/mediaiklan/permintaan/:id' component={PagePersetujuanMedia}/>
                    <Route exact path='/admin/mediaiklan/publik' component={PageMediaPublik}/>
                    <Route exact path='/admin/mediaiklan/block' component={PageMediaBlock}/>
                    <Route exact path='/admin/mediaiklan/daftar' component={PageAllMedia}/>
                    <Route exact path='/admin/mediaiklan/form' component={PageAddMedia}/>
                    
                    <Route exact path='/admin/mitra' component={PageMitra}/>
                    <Route exact path='/admin/advertiser' component={PageAdvertiser}/>
                    {/* <Route exact path='/admin/mediaiklan/permintaan/:id' component={FormPermintaan}/> */}
                    {/* <Route exact path='/admin/mediaiklan/detail/:id' component={PageDetail}/> */}
                    {/* <Route path='/admin/mediaiklan/publik' component={PagePublishMedia}/> */}
                    {/* <Route path='/admin/mediaiklan/blokir' component={PageBlokirMedia}/> */}
                    {/* <Route path='/admin/mediaiklan/daftar' component={PageAllMedia}/> */}
                    {/* <Route path='/admin/mediaiklan/form' component={Form}/> */}
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
