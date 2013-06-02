<?php
namespace Drola;

class PDF
{
    private $_zpdf;
    private $_filename;
    private $_encoding;
    private $_font;
    private $_page;
    private $_last_geometry;
    private $_current_point;

    /**
     * Create PDF file
     * 
     * @param string $filename Filename
     *
     * @return mixed Returns PDF instance on success or FALSE on failure.
     */
    public static function open_file(string $filename)
    {
        return new PDF($filename);
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
        $fonts = array(
            'courier' => Zend_Pdf_Font::FONT_COURIER,
            'courier-bold' => Zend_Pdf_Font::FONT_COURIER_BOLD,
            'courier-oblique' => Zend_Pdf_Font::FONT_COURIER_ITALIC,
            'courier-italic' => Zend_Pdf_Font::FONT_COURIER_ITALIC,
            'courier-bold-italic' => Zend_Pdf_Font::FONT_COURIER_BOLD_ITALIC,
            'courier-boldoblique' => Zend_Pdf_Font::FONT_COURIER_BOLD_ITALIC,
            'times' => Zend_Pdf_Font::FONT_TIMES,
            'times-bold' => Zend_Pdf_Font::FONT_TIMES_BOLD,
            'times-italic' => Zend_Pdf_Font::FONT_TIMES_ITALIC,
            'times-bold-italic' => Zend_Pdf_Font::FONT_TIMES_BOLD_ITALIC,
            'times-bolditalic' => Zend_Pdf_Font::FONT_TIMES_BOLD_ITALIC,
            'times-roman' => Zend_Pdf_Font::FONT_TIMES,
            'times-roman-bold' => Zend_Pdf_Font::FONT_TIMES_BOLD,
            'times-roman-italic' => Zend_Pdf_Font::FONT_TIMES_ITALIC,
            'times-roman-bold-italic' => Zend_Pdf_Font::FONT_TIMES_BOLD_ITALIC,
            'helvetica' => Zend_Pdf_Font::FONT_HELVETICA,
            'helvetica-bold' => Zend_Pdf_Font::FONT_HELVETICA_BOLD,
            'helvetica-italic' => Zend_Pdf_Font::FONT_HELVETICA_ITALIC,
            'helvetica-oblique' => Zend_Pdf_Font::FONT_HELVETICA_ITALIC,
            'helvetica-bold-italic' => Zend_Pdf_Font::FONT_HELVETICA_BOLD_ITALIC,
            'helvetica-boldoblique' => Zend_Pdf_Font::FONT_HELVETICA_BOLD_ITALIC,
            'symbol' => Zend_Pdf_Font::FONT_SYMBOL,
            'zapfdingbats' => Zend_Pdf_Font::FONT_ZAPFDINGBATS
        );
        
        try {
            $font = isset($fonts[strtolower($font)])?$fonts[strtolower($font)]:false;
            if ($font === false) {
                return false;
            }

            $this->_font = Zend_Pdf_Font::fontWithName($font);
            if ($this->_page) {
                $this->_page->setFont($font, $size);
            }

            return true;
        } catch(Exception $e) {

        }

        return false;
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
        if (!$this->_page) {
            return false;
        }

        try {
            $this->_page->drawText($text, $x, $y, $this->_encoding);
            return true;
        } catch(Exception $e) {
        }

        return false;
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
        if (!$this->_page) {
            return false;
        }

        try {
            $this->_page->setFillColor(new Zend_Pdf_Color_GrayScale($gray));
            return true;
        } catch(Exception $e) {
        }

        return false;
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
        //Source: http://stackoverflow.com/a/8076461
        if ($this->_page instanceof Zend_Pdf_Page ) {
            $font = $this->_page->getFont();
            $fontSize = $this->_page->getFontSize();
        } elseif ($this->_page instanceof Zend_Pdf_Resource_Font ) {
            $font = $this->_page;
            if( $fontSize === null ) return false;
        }

        if (!$font instanceof Zend_Pdf_Resource_Font ) {
            return false;
        }
        $drawingText = $text;//iconv ( '', $encoding, $text );
        $characters = array ();
        for ($i = 0; $i < strlen($drawingText); $i++) {
            $characters[] = ord($drawingText[$i]);
        }
        $glyphs = $font->glyphNumbersForCharacters($characters);
        $widths = $font->widthsForGlyphs($glyphs);
        $textWidth = (array_sum($widths) / $font->getUnitsPerEm()) * $fontSize;

        return $textWidth;
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
        $this->_last_geometry = array('rect', func_get_args());
        return true;
    }

    /**
     * Fill current path
     * Fills the interior of the current path with the current fill color.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function fill()
    {
        if (!is_array($this->_last_geometry) || !$this->_page) {
            return false;
        }

        switch($this->_last_geometry[0]) {
        case 'rect':
            $this->_page->drawRectangle(
                $this->_last_geometry[1][0],
                $this->_last_geometry[1][1],
                $this->_last_geometry[1][0] + $this->_last_geometry[1][2],
                $this->_last_geometry[1][1] + $this->_last_geometry[1][3],
                Zend_Pdf_Page::SHAPE_DRAW_FILL
            );
            return true;
            break;
        }

        return false;
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
        $this->_current_point = func_get_args();
        return true;
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
        if ($this->_current_point) {
            $this->_last_geometry = array('line', array($this->_current_point, func_get_args()));
            return true;
        }

        return false;
    }

    /**
     * Stroke path
     * Strokes the path with the current color and line width, and clear it.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function stroke()
    {
        if (!is_array($this->_last_geometry) || !$this->_page) {
            return false;
        }

        switch($this->_last_geometry[0]) {
        case 'rect':
            $this->_page->drawRectangle(
                $this->_last_geometry[1][0],
                $this->_last_geometry[1][1],
                $this->_last_geometry[1][0] + $this->_last_geometry[1][2],
                $this->_last_geometry[1][1] + $this->_last_geometry[1][3],
                Zend_Pdf_Page::SHAPE_DRAW_STROKE
            );
            return true;
            break;
        case 'line':
            $this->_page->drawLine(
                $this->_last_geometry[1][0][0],
                $this->_last_geometry[1][0][1],
                $this->_last_geometry[1][1][0],
                $this->_last_geometry[1][1][1]
            );
            return true;
            break;
        }

        return false;
    }

    /**
     * Saves the current graphics state
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function save()
    {
        if (!$this->_page) {
            return false;
        }

        $this->_page->saveGS();
        return true;
    }

    /**
     * Clip to current path
     * Uses the current path as clipping path, and terminate the path.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function clip()
    {
        if (!is_array($this->_last_geometry) || !$this->_page) {
            return false;
        }

        switch($this->_last_geometry[0]) {
        case 'rect':
            $this->_page->clipRectangle(
                $this->_last_geometry[1][0],
                $this->_last_geometry[1][1],
                $this->_last_geometry[1][0] + $this->_last_geometry[1][2],
                $this->_last_geometry[1][1] + $this->_last_geometry[1][3]
            );
            return true;
            break;
        }

        return false;
    }

    /**
     * Restore graphics state
     * Restores the most recently saved graphics state.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function restore()
    {
        if (!$this->_page) {
            return false;
        }

        $this->_page->restoreGS();
        return true;
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
        $this->_page = $this->_zpdf->newPage($width, $height);
        $this->_zpdf->pages[] = $this->_page;
    }

    /**
     * Finish page
     * Finishes the page.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function end_page()
    {
        $this->_page = null;
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
        if (!$this->_page) {
            return false;
        }

        $this->_page->translate($tx, $ty);
    }

    /**
     * Close pdf resource
     * Closes the generated PDF file, and frees all document-related resources.
     * 
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function close()
    {
        $this->_zpdf->save($this->_filename);
    }

    /**
     * Add bookmark for current page
     * 
     * @param string $text Bookmark title
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    function add_outline(string $text)
    {
        if (!$this->_page) {
            return false;
        }

        $this->_zpdf->outlines[] = Zend_Pdf_Outline::create(
            $text,
            Zend_Pdf_Destination_Fit::create($this->_page)
        );

        return true;
    }
}