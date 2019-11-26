import React, { Component } from 'react';
import Card from '@material-ui/core/Card';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import Divider from '@material-ui/core/Divider';
import Icon from '@material-ui/core/Icon';
import Box from '@material-ui/core/Box';
import { NavLink } from 'react-router-dom';

const  styles = {
    media: {
       height: 0,
       paddingTop: '56.25%' // 16:9
    },
    card: {
       position: 'relative',
    },
    
    cardContent:{
        height: 'auto',
        paddingLeft: '100px'
    },
    link:{
        textDecoration: 'none',
        color: 'black',
    }
 }

export class Statusbox extends Component {
    render() {
        const {color} = this.props;
        const boxStyle = {
            overlay: {
                position: 'absolute',
                top: '0px',
                left: '15px',
                color: 'white',
                backgroundColor: color,
                width: '80px',
                height: '80px',
                fontSize: '50px', 
                borderRadius: '5px',
             },
        }
        return (
            <div style={styles.card}>
                <Box style={boxStyle.overlay} display="flex" justifyContent="center" alignItems="center">
                    <Icon fontSize='inherit'>{this.props.icon}</Icon>
                </Box>
                <div style={{height: '15px'}}/>
                <Card >
                    <CardContent style={styles.cardContent}>
                        <Typography component="div">
                            <Box fontSize={14} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">{this.props.title}</Box>
                            <Box fontSize={24} fontFamily="Roboto Light" display="flex" justifyContent="flex-end" alignItems="center">{this.props.subTitle}</Box>
                        </Typography>
                    </CardContent>
                    <Divider variant='middle'/>
                    <CardActions>
                        <NavLink to={this.props.to} style={styles.link}>Lihat Detail</NavLink>
                    </CardActions>
                </Card>
            </div>
        );
    }
}

export default Statusbox;
