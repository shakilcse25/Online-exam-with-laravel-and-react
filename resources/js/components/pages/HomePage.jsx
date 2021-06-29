import React from 'react';
import Button from "@material-ui/core/Button";
import Exam from "../../images/exam.jpg";
import Typography from "@material-ui/core/Typography";

function HomePage() {
    return (
        <div className="home-area">
            <div className="home-main container">
                <div className="row">
                    <div className="col-lg-6">
                        <div className="image-exam">
                            <img src={Exam} alt="Exam" />
                        </div>
                    </div>
                    <div className="col-lg-6">
                        <div className="exam-details">
                            <Typography variant="h6">
                                Online Exam
                            </Typography>
                            <Typography variant="h4" style={{ fontWeight: 'bold', color: '#f5365c' , margin: '20px 0' }}>
                                Online Testing Platform
                            </Typography>
                            <p className="u-text u-text-3">Vivamus arcu felis bibendum ut tristique et. Habitant morbi
                                tristique senectus et netus et malesuada fames. Sapien eget mi proin sed libero enim
                                sed.
                            </p>
                            <p>
                                <Button variant="outlined" color="secondary">
                                Register & Enter Exam
                                </Button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default HomePage;
