import React, { Component } from 'react';
import NumberFormat from 'react-number-format';
import TextField from '@material-ui/core/TextField';
import MBreadcumb from '../components/Material-UI/Breadcumbs/MBreadcumb'

const bread = [
    {title: 'dashboard', icon: 'dashboard', active: false},
    {title: 'dashboard', icon: 'dashboard', active: true},
];
export class Testing extends Component {
    
    render(){
        return (
            <div>
                <MBreadcumb items={bread}/>
                Dashboard
                <NumberFormat value={2456981} customInput={(props) => <TextField {...props} name='lebar' id="lebar" label="Lebar" margin="dense" variant="outlined"/>} thousandSeparator={'.'} decimalSeparator=','/>
            </div>
        );
    }
}

export default Testing;