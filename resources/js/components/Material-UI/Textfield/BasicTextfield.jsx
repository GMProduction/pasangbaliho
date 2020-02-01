import React, {Component} from 'react'
import TextField from '@material-ui/core/TextField';

export class BasicTextfield extends Component {


    render(){
        return(
            <div>
                <TextField 
                    margin="dense" 
                    variant="outlined" 
                    size="small" 
                    fullWidth
                    label={this.props.label}
                    placeholder={this.props.placeholder}
                    name={this.props.name} 
                    inputProps={this.props.InputProps}
                    id={this.props.id} 
                    value={this.props.value} 
                    onChange={this.props.onChange}/>
            </div>
        );
    }
}

export default BasicTextfield;