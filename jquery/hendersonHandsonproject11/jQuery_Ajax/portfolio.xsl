<?xml version="1.0" encoding="UTF-8" ?>
<!--
   New Perspectives on XML, 3rd Edition
   Tutorial 5
   Review Assignment

   Chesterton Financial XSL Style Sheet
   Author: Rafael Garcia
   Date:   3/1/2017

   Filename:         portfolio.xsl
   Supporting Files: down.png, same.png, portfolio.css, up.png

-->

<xsl:stylesheet version="1.0"
     xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

   <xsl:output method="html"
      doctype-system="about:legacy-compat"
      encoding="UTF-8"
      indent="yes" />

   <xsl:template match="/">
      <html>
         <head>
            <title>Portfolio Stocks</title>
            <link href="portfolio.css" rel="stylesheet" type="text/css" />
         </head>

         <body>

            <header>
               <section>
                  Last Updated: 
                  <xsl:value-of select="portfolio/date" /> 
                  at
                  <xsl:value-of select="portfolio/time" />
               </section>

               <h1>Chesterton Financial</h1>
               <h2>Portfolio Stocks</h2>
            </header>

            <section>
               <h1>Industrials</h1>
               <xsl:apply-templates select="portfolio/stock[category='Industrials']">
                  <xsl:sort select="sName" />
               </xsl:apply-templates>
            </section>

            <section>
               <h1>Utilities</h1>
               <xsl:apply-templates select="portfolio/stock[category='Utilities']">
                  <xsl:sort select="sName" />
               </xsl:apply-templates>
            </section>

            <section>
               <h1>Transportation</h1>
               <xsl:apply-templates select="portfolio/stock[category='Transportation']">
                  <xsl:sort select="sName" />
               </xsl:apply-templates>
            </section>

         </body>

      </html>
   </xsl:template>

   <xsl:template match="today">
      <table>
         <tr>
            <th>Current</th>
            <th>Open</th>
            <th>High</th>
            <th>Low</th>
            <th>Volume</th>
         </tr>
         <tr>
            <td><xsl:value-of select="@current" /></td>
            <td><xsl:value-of select="@open" /></td>
            <td><xsl:value-of select="@high" /></td>
            <td><xsl:value-of select="@low" /></td>
            <td><xsl:value-of select="@vol" /></td>
         </tr>            
      </table>
   </xsl:template>

   <xsl:template match="summary">
      <table>
         <tr>
            <th>Web Address</th>
            <td>
               <a href="{link}">
                  <xsl:value-of select="link" />
               </a>
            </td>
         </tr>
         <tr>
            <th>52wk. Range</th>
            <td>
               <xsl:value-of select="low" /> -
               <xsl:value-of select="high" />
            </td>
         </tr>
         <tr>
            <th>P/E</th>
            <td>
               <xsl:value-of select="pe_ratio" />
            </td>
         </tr>
         <tr>
            <th>EPS</th>
            <td>
               <xsl:value-of select="eps" />
            </td>
         </tr>
         <tr>
            <th>Div. and Yield</th>
            <td>
               <xsl:value-of select="dividend" />
               (<xsl:value-of select="yield" />)
            </td>
         </tr>
      </table>
   </xsl:template>


   <xsl:template match="stock">
      <article>

         <xsl:apply-templates select="today" />
         <xsl:apply-templates select="summary" />

         <h1>
            <xsl:value-of select="sName" />
            (<xsl:value-of select="sName/@symbol" />)
         </h1>
         <xsl:choose>
            <xsl:when test="today/@current &lt; today/@open">
               <h2 class="down">
                  <img src="down.png" alt="down" />
                   <xsl:value-of select="today/@current" />
               </h2>
            </xsl:when>
            <xsl:when test="today/@current > today/@open">
               <h2 class="up">
                  <img src="up.png" alt="up" />
                  <xsl:value-of select="today/@current" />
               </h2>
            </xsl:when>
            <xsl:otherwise>
               <h2 class="same">
                  <img src="same.png" alt="same" />
                  <xsl:value-of select="today/@current" />
               </h2>
            </xsl:otherwise>
         </xsl:choose>

         <p>
            <xsl:value-of select="description" />
         </p>
      </article>
   </xsl:template>



</xsl:stylesheet>
