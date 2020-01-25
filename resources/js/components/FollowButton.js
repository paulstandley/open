import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class FollowButton extends Component {
    constructor(props) {
        super(props);
        this.state = { 
            follow: false
         }
         console.log(props);
    }

    componentDidMount() {
        axios.get('/folling/' + 1).then(response => {
            console.log(response);
        })
    }

    followUser() {
        axios.post('/follow/' + 1).then(resonse => {
            if(this.state.follow) {
                this.setState({follow: !follow})
            }
            console.log(resonse);
        }).catch(errors => {
            if(errors.response.status == 401) {
                window.location = '/login';
            }
        });
    }

    render() { 
        return ( 
            <React.Fragment>
                <button className="btn btn-primary" onClick={this.followUser}>{this.state.follow ? 'Unfollow' : 'Follow'}</button>
            </React.Fragment>
         );
    }
}
 
export default FollowButton;


if (document.getElementById('buttonId')) {
    ReactDOM.render(<FollowButton />, document.getElementById('buttonId'));
}
