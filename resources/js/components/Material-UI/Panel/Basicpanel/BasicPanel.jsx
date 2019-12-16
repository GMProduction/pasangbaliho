import React, { Component } from 'react';
import Box from '@material-ui/core/Box';
import Paper from '@material-ui/core/Paper';

const styles ={
    card: {
        position: 'relative',
     },
     panel: {
        position: 'relative',
        paddingLeft: '15px',
        paddingRight: '15px',
        height: '15px'
    },
    content:{
        padding: '40px 15px 15px 15px'
    }
}

export class BasicPanelContent extends Component {

    render() {
        return (
            <div>
                <Paper style={styles.content}>
                    {this.props.children}
                </Paper>
            </div>
        );
    }
}

export class BasicPanelHeader extends Component {

    render() {
        const style ={
            overlay: {
                top: '0px',
                color: 'white',
                backgroundColor: !this.props.color ? '#123456' : this.props.color,
                borderRadius: '5px',
                paddingLeft: '15px',
                paddingRight: '15px',
                height: '50px',
                width: '100%'
            }
        }
        return (
            <div style={styles.panel}>
                <Box style={style.overlay} display='flex' alignItems='center'>
                    {this.props.children}
                </Box>
            </div>
        );
    }
}

export class BasicPanel extends Component {
    render() {

        // const header = React.Children.map(this.props.children, (child, i) => {
        //     if (child.type.name === 'BasicPanelHeader') {
        //         return child;
        //     }
        // });

        // const content = React.Children.map(this.props.children, (child, i) => {
        //     if (child.type.name === 'BasicPanelContent') {
        //         return child;
        //     }
        // });
        
        return (
            <div style={styles.card}>
                {this.props.children}
            </div>
        );
    }
}

export default BasicPanel;
