import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import Dashboard from '../page/Dashboard/Dashboard';
import PageNegosiasi from './Negosiasi/PageNegosiasi';
import PagePermintaanHarga from './Negosiasi/PagePermintaanHarga';
import PageBeriHarga from './Negosiasi/PageBeriHarga';

export class PageRouter extends Component {
    render() {
        return (
            <div>
                <Switch>
                    <Route exact path='/admin' component={Dashboard}/>

                    {/* <Route exact path='/admin/mediaiklan' component={PageMedia}/>
                    <Route exact path='/admin/mediaiklan/permintaan' component={PageRequestMedia}/>
                    <Route exact path='/admin/mediaiklan/permintaan/:id' component={FormPermintaan}/>
                    <Route exact path='/admin/mediaiklan/detail/:id' component={PageDetail}/>
                    <Route path='/admin/mediaiklan/publik' component={PagePublishMedia}/>
                    <Route path='/admin/mediaiklan/blokir' component={PageBlokirMedia}/>
                    <Route path='/admin/mediaiklan/daftar' component={PageAllMedia}/> */}
                    {/* <Route path='/admin/mediaiklan/form' component={Form}/> */}
                    <Route exact path='/admin/negosiasi' component={PageNegosiasi}/>
                    <Route exact path='/admin/negosiasi/permintaan' component={PagePermintaanHarga}/>
                    <Route exact path='/admin/negosiasi/permintaan/:id' component={PageBeriHarga}/>

                </Switch>
            </div>
        );
    }
}

export default PageRouter;
