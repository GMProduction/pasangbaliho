import React, {Component} from 'react';

import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormHelperText from '@material-ui/core/FormHelperText';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';

export class RadioButton extends Component {


    render(){
        const {label, value, onChange, name} = this.props;
        return(
            <div>
                <FormControl component="fieldset">
                    <FormLabel component="legend">{label}</FormLabel>
                    <RadioGroup name={name} value={value} onChange={onChange}>
                        {
                            this.props.items.map( (row, i) => {
                                return(
                                    <FormControlLabel key={i} value={row.value} control={<Radio color="primary"/>} label={row.label} />
                                )
                            })
                        }
                    </RadioGroup>
                </FormControl>
            </div>
        );
    }
}

export default RadioButton;