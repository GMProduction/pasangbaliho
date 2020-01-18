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
                    placeholder={this.props.placeholder}
                    name={this.props.name} 
                    inputProps={this.props.inputProps}
                    id={this.props.id} 
                    value={this.props.value} 
                    onChange={this.props.onChange}/>
            </div>
        );
    }
}

export default BasicTextfield;