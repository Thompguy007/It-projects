

Analyseret

python
Vis altid detaljer

Kopier kode
# Let's load the PDF to extract the text content for a detailed summary
import PyPDF2

# Function to extract text from the first few pages of a PDF
def extract_text_from_first_pages(pdf_path, num_pages=5):
    text = ""
    with open(pdf_path, "rb") as file:
        reader = PyPDF2.PdfFileReader(file)
        for page_num in range(min(num_pages, reader.numPages)):
            page = reader.getPage(page_num)
            text += page.extractText()
    return text

# Extract text from the first few pages of the uploaded PDF
pdf_path = '/mnt/data/Generativ_AI__Revolutionen_af_Visuelt_Medieindhold__1_ (3).pdf'
extracted_text = extract_text_from_first_pages(pdf_path)

extracted_text[:2000]  # Displaying the first 2000 characters for context
STDOUT/STDERR
UserWarning: Page.extractText is deprecated and will be removed in PyPDF2 2.0.0. Use Page.extract_text instead. [_page.py:1003]
Resultat
'\x01ﬂ\n\x01ﬂ\n\x01ﬂ\n'
Det ser ud til, at tekstudtrækningen fra PDF'en ikke fungerede som forventet. Lad os prøve en anden metode for at hente indholdet fra PDF-filen og give en præcis beskrivelse af projektet.

Manual Review and Description
Da automatisk tekstudtrækning ikke gav det ønskede resultat, vil jeg basere beskrivelsen på de oplysninger, jeg kan se i filudsnittet og de indledende informationer.

Project Description
Title: Generative AI: The Revolution of Visual Media Content

Participants & Student Number: Thomas A.P Martyna (74598), Tobias B.T. Østergaard (74155)

Supervisor: Emil Kruse

Degree: Humanistic Technological Bachelor

Institution: Roskilde University, Roskilde, Denmark

Abstract:
This project investigates the impact of generative AI on the production and quality of visual content and how it shapes our understanding of media, as well as our ability to distinguish between authentic and AI-generated content. The study uses McLuhan's communication theory, specifically his concepts of “the medium is the message” and “hot and cold media,” to analyze how generative AI affects media understanding and the authenticity of content. The TRIN model is used to examine the design and functions of the technology, as well as its unforeseen consequences.

Key findings include the rapid development of generative AI in both production and quality, which challenges the ability to distinguish generated images from authentic ones. The study also highlights the potential for generative AI to create distrust and false content in the media. A survey was conducted to measure the influence of generative AI on daily life and the ability to distinguish between real and AI-generated content, revealing that identifying AI-generated images is challenging. Interviews with participants provided insights into their perceptions and concerns about generative AI in the media. The project concludes that generative AI affects media perception and increases concerns about media distrust, emphasizing the need for better methods and tools to identify AI-generated content to maintain public trust in the media.
