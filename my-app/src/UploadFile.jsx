import React, { useState } from 'react';
import axios from 'axios';
import './UploadFile.css'; 

const UploadFile = () => {
    const [file, setFile] = useState(null);
    const [notes, setNotes] = useState([]);

    const handleFileChange = (e) => setFile(e.target.files[0]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        if (!file) return alert('Please upload a file');

        const formData = new FormData();
        formData.append('file', file);

        try {
            const { data } = await axios.post('http://localhost:8000/api/import', formData);
            setNotes(data);
        } catch (error) {
            alert('Failed to upload file');
            console.error('Error uploading file:', error);
        }
    };

    return (
        <div>
            <h1>Upload Excel File</h1>
            <form onSubmit={handleSubmit}>
                <input type="file" accept=".xlsx" onChange={handleFileChange} />
                <button type="submit">Upload</button>
            </form>

            {notes.length > 0 && (
                <table>
                    <thead>
                        <tr>
                            {notes[0].filter(header => header).map((header, index) => (
                                <th key={index}>{header}</th>
                            ))}
                        </tr>
                    </thead>
                    <tbody>
                        {notes.slice(1).map((row, rowIndex) => (
                            <tr key={rowIndex}>
                                {row.filter(cell => cell).map((cell, cellIndex) => (
                                    <td key={cellIndex}>{cell}</td>
                                ))}
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
};

export default UploadFile;
