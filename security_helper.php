<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LavaLust Framework - Security Helpers Documentation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 25px;
            color: #333;
            background-color: #f9f9f9;
        }
        h1, h2, h3 {
            color: #2c3e50;
            font-weight: 600;
        }
        h1 {
            border-bottom: 3px solid #3498db;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        h2 {
            margin-top: 35px;
            border-left: 5px solid #3498db;
            padding-left: 15px;
            background-color: #f0f7ff;
            padding: 10px 15px;
            border-radius: 4px;
        }
        h3 {
            margin-top: 25px;
            color: #2980b9;
        }
        code {
            background-color: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.95em;
        }
        pre {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            font-family: 'Consolas', 'Monaco', monospace;
            line-height: 1.5;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .function {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            border-left: 5px solid #3498db;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .param {
            font-weight: bold;
            color: #2980b9;
            font-family: monospace;
        }
        .return {
            font-weight: bold;
            color: #27ae60;
        }
        .note {
            background-color: #fffde7;
            padding: 15px;
            border-left: 4px solid #ffd600;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning {
            background-color: #ffebee;
            padding: 15px;
            border-left: 4px solid #f44336;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table th, .info-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .info-table th {
            background-color: #3498db;
            color: white;
        }
        .info-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .info-table tr:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <h1>LavaLust Framework - Security Helpers</h1>
    
    <p>The Security Helper provides functions for input filtering, filename sanitization, and CSRF protection in your LavaLust PHP Framework application.</p>

    <div class="function">
        <h2>filter_io()</h2>
        
        <h3>Description</h3>
        <p>Filters input data according to specified type using PHP's filter_var functions.</p>
        
        <h3>Syntax</h3>
        <pre>filter_io(string $type, mixed $var)</pre>
        
        <h3>Parameters</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Default</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="param">$type</span></td>
                    <td>string</td>
                    <td>Type of filtering to apply. Supported values: 'string', 'int'/'integer', 'float', 'url', 'email'</td>
                    <td><em>Required</em></td>
                </tr>
                <tr>
                    <td><span class="param">$var</span></td>
                    <td>mixed</td>
                    <td>The input data to be filtered</td>
                    <td><em>Required</em></td>
                </tr>
            </tbody>
        </table>
        
        <h3>Return Value</h3>
        <p><span class="return">mixed</span> - The filtered data</p>
        
        <h3>Filter Types</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>PHP Filter Used</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>string</td>
                    <td>FILTER_UNSAFE_RAW</td>
                    <td>Returns the raw input (no filtering)</td>
                </tr>
                <tr>
                    <td>int/integer</td>
                    <td>FILTER_SANITIZE_NUMBER_INT</td>
                    <td>Removes all characters except digits and +- signs</td>
                </tr>
                <tr>
                    <td>float</td>
                    <td>FILTER_SANITIZE_NUMBER_FLOAT</td>
                    <td>Removes all characters except digits, +- signs, and decimal separator</td>
                </tr>
                <tr>
                    <td>url</td>
                    <td>FILTER_SANITIZE_URL</td>
                    <td>Removes all illegal URL characters</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>FILTER_SANITIZE_EMAIL</td>
                    <td>Removes all illegal email characters</td>
                </tr>
            </tbody>
        </table>
        
        <h3>Example Usage</h3>
        <pre>// Filter string input
$clean_string = filter_io('string', $_POST['user_input']);

// Filter integer input
$clean_int = filter_io('int', $_GET['page']);

// Filter email input
$clean_email = filter_io('email', $_POST['email']);</pre>
        
        <div class="warning">
            <h4>Security Notes</h4>
            <ul>
                <li>FILTER_UNSAFE_RAW doesn't actually sanitize input - consider additional validation</li>
                <li>For strings that will be output to HTML, use htmlspecialchars()</li>
                <li>Consider combining with validation functions</li>
            </ul>
        </div>
    </div>

    <div class="function">
        <h2>sanitize_filename()</h2>
        
        <h3>Description</h3>
        <p>Sanitizes a filename to prevent directory traversal and other security issues.</p>
        
        <h3>Syntax</h3>
        <pre>sanitize_filename(string $filename)</pre>
        
        <h3>Parameters</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Default</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="param">$filename</span></td>
                    <td>string</td>
                    <td>Filename to be sanitized</td>
                    <td><em>Required</em></td>
                </tr>
            </tbody>
        </table>
        
        <h3>Return Value</h3>
        <p><span class="return">string</span> - The sanitized filename</p>
        
        <h3>Features</h3>
        <ul>
            <li>Prevents directory traversal attacks</li>
            <li>Removes potentially dangerous characters</li>
            <li>Uses the framework's security component</li>
        </ul>
        
        <h3>Example Usage</h3>
        <pre>// Sanitize uploaded file name
$original_name = $_FILES['userfile']['name'];
$safe_name = sanitize_filename($original_name);

// Use with file operations
$file_path = '/uploads/' . sanitize_filename($user_provided_name);</pre>
        
        <div class="note">
            <h4>Best Practices</h4>
            <ul>
                <li>Always sanitize filenames before using them in filesystem operations</li>
                <li>Consider adding your own validation for allowed file extensions</li>
                <li>For uploaded files, consider generating unique names instead of using user-provided names</li>
            </ul>
        </div>
    </div>

    <div class="function">
        <h2>csrf_field()</h2>
        
        <h3>Description</h3>
        <p>Generates a hidden input field containing the CSRF token for forms.</p>
        
        <h3>Syntax</h3>
        <pre>csrf_field()</pre>
        
        <h3>Parameters</h3>
        <p>None</p>
        
        <h3>Return Value</h3>
        <p><span class="return">void</span> - Outputs the HTML directly</p>
        
        <h3>Features</h3>
        <ul>
            <li>Generates a CSRF token hidden field</li>
            <li>Includes random noise to make tokens harder to detect</li>
            <li>Uses the framework's security component</li>
            <li>Automatically handles token generation and validation</li>
        </ul>
        
        <h3>Example Usage</h3>
        <pre>&lt;form method="post" action="/process"&gt;
    &lt;?php csrf_field(); ?&gt;
    &lt;!-- other form fields --&gt;
    &lt;button type="submit"&gt;Submit&lt;/button&gt;
&lt;/form&gt;</pre>
        
        <h3>Generated Output Example</h3>
        <pre>&lt;input type="hidden" name="csrf_token_name" value="a1b2c3d4e5f6..." /&gt;</pre>
        
        <div class="warning">
            <h4>Security Requirements</h4>
            <ul>
                <li>Must be included in all forms that modify data (POST, PUT, DELETE requests)</li>
                <li>Requires the framework's CSRF protection to be enabled in config</li>
                <li>Tokens are session-based and expire when the session expires</li>
            </ul>
        </div>
    </div>

    <h2>Security Best Practices</h2>
    <ul>
        <li>Always filter and validate user input</li>
        <li>Use CSRF protection for all state-changing requests</li>
        <li>Sanitize all filenames used in filesystem operations</li>
        <li>Combine these helpers with proper output escaping</li>
        <li>Keep the framework updated to receive security patches</li>
    </ul>

    <h2>Implementation Notes</h2>
    <ul>
        <li>The CSRF token is automatically validated by the framework</li>
        <li>For AJAX requests, you'll need to include the CSRF token in headers</li>
        <li>Consider implementing additional security headers (CSP, XSS protection)</li>
        <li>These helpers are designed to work with the framework's security system</li>
    </ul>
</body>
</html>