import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Navigasi from '../components/Material-UI/Navigasi/Navigasi';
import Footer from '../components/Material-UI/Navigasi/Footer';
import CssBaseline from '@material-ui/core/CssBaseline';
import { BrowserRouter } from 'react-router-dom';
import PageRouter from './PageRouter';


export default class Main extends Component {
    render() {
        return (
            <React.Fragment>
                <CssBaseline/>
                <div className='mainWrap'>
                    <BrowserRouter>
                        <Navigasi/>
                        <main style={{backgroundColor: '#EEEEEE'}}>
                            <PageRouter/>
                        </main>
                        <Footer/>
                    </BrowserRouter>
                </div>
            </React.Fragment>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Main/>,document.getElementById('root'));
}


