import React, { Component } from 'react';
import TextField from '@material-ui/core/TextField';

export class Child extends Component {

    constructor(props) {
        super(props);
        this.state = {
            lebar: ''
        }
    }
    
    render() {
        return (
            <div>
                <TextField name='lebar' id="lebar" label="Lebar" margin="dense" variant="outlined" fullWidth
                    value={this.props.searchValue} onChange={this.props.onSearchChange}/>
                                    
            </div>
        );
    }
}

export default Child;
