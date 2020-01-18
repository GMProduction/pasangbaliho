import React, {Component} from 'react'
import TextField from '@material-ui/core/TextField';
import NumberFormat from 'react-number-format';

export class NumberTextfield extends Component{

    render(){
        return(
            <div>
                <NumberFormat 
                    variant="outlined" 
                    margin="dense" 
                    fullWidth 
                    label={this.props.label}
                    placeholder={this.props.placeholder} 
                    InputProps={this.props.inputProps} 
                    value={this.props.value} 
                    onValueChange={this.props.onChange} 
                    customInput={TextField} 
                    thousandSeparator={'.'} 
                    decimalSeparator=','/>
            </div>
        );
    }
}

export default NumberTextfield;