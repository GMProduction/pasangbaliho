import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import Dashboard from '../page/Dashboard/Dashboard';
import PageMedia from './MediaIklan/PageMedia';
import PageConfirmMedia from './MediaIklan/PageConfirmMedia';
import PageListMedia from './MediaIklan/PageListMedia';

import PageNegosiasi from './Negosiasi/PageNegosiasi';
import PageListNego from './Negosiasi/PageListNego';
import PageBeriHarga from './Negosiasi/PageBeriHarga';
import PageHargaDeal from './Negosiasi/PageHargaDeal';
import PageNegoSelesai from './Negosiasi/PageNegoSelesai';
import PageMitra from './Mitra/PageMitra';
import PageAdvertiser from './Advertiser/PageAdvertiser';

export class PageRouter extends Component {
    render() {
        return (
            <div>
                <Switch>
                    <Route exact path='/' component={Dashboard}/>

                    <Route exact path='/mitra' component={PageMitra}/>
                    
                    <Route exact path='/advertiser' component={PageAdvertiser}/>

                    <Route exact path='/mediaiklan' component={PageMedia}/>
                    <Route exact path='/mediaiklan/permintaan' render={(props) => <PageListMedia {...props} filter='pending'/>} />
                    <Route exact path='/mediaiklan/publish' render={(props) => <PageListMedia {...props} filter='publish'/>} />
                    <Route exact path='/mediaiklan/block' render={(props) => <PageListMedia {...props} filter='block'/>} />
                    <Route exact path='/mediaiklan/permintaan/:id' render={(props) => <PageConfirmMedia {...props} filter='confirm'/>}/>
                    <Route exact path='/mediaiklan/detail/:id' render={(props) => <PageConfirmMedia {...props} filter='update'/>}/>
                    <Route exact path='/mediaiklan/form' render={(props) => <PageConfirmMedia {...props} filter='add'/>}/>
                    
                    
                    <Route exact path='/negosiasi' component={PageNegosiasi}/>
                    <Route exact path='/negosiasi/permintaan' render={(props) => <PageListNego {...props} filter='permintaan'/>}/>
                    <Route exact path='/negosiasi/negoharga' render={(props) => <PageListNego {...props} filter='negoharga'/>}/>
                    <Route exact path='/negosiasi/negomateri' render={(props) => <PageListNego {...props} filter='negomateri'/>}/>
                    <Route exact path='/negosiasi/permintaan/:id' component={PageBeriHarga}/>
                    <Route exact path='/negosiasi/negoharga/:id' component={PageHargaDeal}/>
                    <Route exact path='/negosiasi/negomateri/:id' component={PageNegoSelesai}/>
                    <Route render={() => <h1>Not Found</h1>}/>
                </Switch>
            </div>
        );
    }
}

export default PageRouter;
