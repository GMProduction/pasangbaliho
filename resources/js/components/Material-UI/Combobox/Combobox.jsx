import React, {Component} from 'react'

import FormControl from '@material-ui/core/FormControl';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';

export class Combobox extends Component {

    render(){
        return(
            <div>
                <FormControl variant='outlined' margin='dense' fullWidth>
                    <InputLabel id="demo-simple-select-outlined-label">
                        {this.props.label}
                    </InputLabel>
                    <Select
                        id="demo-simple-select-outlined"
                        value={this.props.value}
                        onChange={this.props.onChange}
                        labelWidth={80}
                        name={this.props.name}
                        >
                            {this.props.children}
                    </Select>
                </FormControl>
            </div>
        );
    }
}

export default Combobox;