<?php
namespace CmsWorks\CwFluidmail\View;


/***************************************************************
*
*  Copyright notice
*
*  (c) 2014 Arjan de Pooter <arjan@cmsworks.nl>, CMS Works BV
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class MailView extends \TYPO3\CMS\Fluid\View\StandaloneView {

	/**
	* Renders the sections which we need: subject, plain, html
	* @return array Rendered sections
	*
	*/
	public function render() {
		$this->templateParser->setConfiguration($this->buildParserConfiguration());

		$templateIdentifier = $this->getTemplateIdentifier();
		if ($this->templateCompiler->has($templateIdentifier)) {
			$parsedTemplate = $this->templateCompiler->get($templateIdentifier);
		} else {
			$parsedTemplate = $this->templateParser->parse($this->getTemplateSource(NULL));
			if ($parsedTemplate->isCompilable()) {
				$this->templateCompiler->store($templateIdentifier, $parsedTemplate);
			}
		}

		$this->startRendering(self::RENDERING_TEMPLATE, $parsedTemplate, $this->baseRenderingContext);
		$variables = $this->baseRenderingContext->getTemplateVariableContainer()->getAll();
		$output = array(
			$this->renderSection('subject', $variables, TRUE),
			$this->renderSection('plain', $variables, TRUE),
			$this->renderSection('html', $variables, TRUE),
		);
		$this->stopRendering();

		return $output;
	}
}
?>
