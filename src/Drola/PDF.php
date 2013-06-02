<?php
namespace Drola;

class PDF
{
    private $_zpdf;
    private $_filename;

    /**
     * Create PDF file
     * 
     * @param string $filename Filename
     *
     * @return mixed Returns PDF instance on success or FALSE on failure.
     */
    public static function open_file(string $filename)
    {

    }

    public function ___construct($filename)
    {
        $this->_filename = $filename;

        if (file_exists($filename)) {
            $this->_zpdf = Zend_Pdf::load($filename);
        } else {
            $this->_zpdf = new Zend_Pdf();
        }
    }

    /**
     * Fill the author document info field
     * 
     * @param string $author Author
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function set_info_author(string $author)
    {
        $this->_zpdf->properties['Author'] = $author;
    }

    /**
     * Fill the creator document info field
     * 
     * @param string $creator Creator
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function set_info_creator(string $creator)
    {
        $this->_zpdf->properties['Creator'] = $creator;
    }


    /**
     * Fill the subject document info field
     * 
     * @param string $subject Subject
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function set_info_subject(string $subject)
    {
        $this->_zpdf->properties['Subject'] = $subject;
    }

    /**
     * Fill the keywords document info field
     * 
     * @param string $keywords Keywords
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function set_info_keywords(string $keywords)
    {
        $this->_zpdf->properties['Keywords'] = $keywords;
    }

    /**
     * Set font
     * 
     * @param string $font     Font
     * @param int    $size     Font size
     * @param string $encoding Encoding
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function set_font(string $font, int $size, string $encoding)
    {

    }

    /**
     * Output text at given position
     * Prints text in the current font.
     * 
     * @param string $text Text
     * @param float  $x    X
     * @param float  $y    Y
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function show_xy(string $text, float $x, float $y)
    {

    }

    /**
     * Set fill color to gray
     * Sets the current fill color to a gray value between 0 and 1 inclusive.
     * 
     * @param float $gray Grayness between 0 and 1
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function setgray_fill(float $gray)
    {

    }

    /**
     * Return width of text
     * Returns the width of text in an arbitrary font.
     *  
     * @param string $text Text
     *
     * @return float Width of text
     */
    public function stringwidth(string $text)
    {

    }

    /**
     * Draw rectangle
     * Draws a rectangle.
     * 
     * @param float $x      X
     * @param float $y      Y
     * @param float $width  Width
     * @param float $height Height
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function rect(float $x, float $y, float $width, float $height)
    {

    }

    /**
     * Fill current path
     * Fills the interior of the current path with the current fill color.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function fill()
    {

    }

    /**
     * Set current point
     * Sets the current point for graphics output.
     * 
     * @param float $x X
     * @param float $y Y
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function moveto(float $x, float $y)
    {

    }

    /**
     * Draw a line
     * Draws a line from the current point to another point.
     * 
     * @param float $x X
     * @param float $y Y
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function lineto(float $x, float $y)
    {

    }

    /**
     * Stroke path
     * Strokes the path with the current color and line width, and clear it.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function stroke()
    {

    }

    /**
     * Saves the current graphics state
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function save()
    {

    }

    /**
     * Clip to current path
     * Uses the current path as clipping path, and terminate the path.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function clip()
    {

    }

    /**
     * Restore graphics state
     * Restores the most recently saved graphics state.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function restore()
    {

    }

    /**
     * Start new page
     *
     * Adds a new page to the document.
     * 
     * @param float $width  Width
     * @param float $height Height
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function begin_page(float $width, float $height)
    {

    }

    /**
     * Finish page
     * Finishes the page.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function end_page()
    {

    }

    /**
     * Set origin of coordinate system
     * Translates the origin of the coordinate system. 
     *  
     * @param float $tx X
     * @param float $ty Y
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function translate(float $tx, float $ty)
    {

    }

    /**
     * Close pdf resource
     * Closes the generated PDF file, and frees all document-related resources.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function close()
    {

    }
}