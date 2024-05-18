# WARNING

Missing HMMER data. This problem will *potentially* be fixed in the future.

# PMDB (PlantMADS Database)

## Introduction

Flowering is a key part of the life cycle of angiosperms. Regulation of flowering process, including floral transition and development of floral organs, is conducted by a complicated mechanism. The core of this mechanism is a series of transcription factors, most of which belong to a protein family called MADS-box transcription factor. The well-known ABC model is a primary abstract of the mechanism of flower morphogenesis. It describes how a series of key factors dominate the morphogenesis of floral organs through coordination and competition, where most of these key factors are MADS-box transcription factors.

MADS-box transcription factor family is defined by a MADS-box domain, which contains about 50 amino acid residuals and has DNA-binding activity. Although MADS-box transcription factors play important roles in the plant-specific flowering process, the family is not plant-specific. The name MADS-box is derived from four proteins that contain this certain domain: MCM1 from *Saccharomyces cerevisiae*, AG from *Arabidopsis thaliana*, DEFA from *Antirrhinum majus*, and SRF from *Homo sapiens*. MADS-box proteins can be divided into two types, namely type I and type II, and this divergence is thought to be ancestral to the divergence of plants and animals.

MADS-box proteins have been proved to be involved in many biological processes of many plant species5. Here we collected information about manually reviewed known MADS-box proteins of plants from SwissProt and built this database, with a primary goal to learn and master the procedure of the construction and presentation of a database, and an ultimate goal to gain further understanding of plant MADS-proteins through a systematic and evolutional perspective, especially about how they obtained their role in flowering control.

## Help

### Transciption Factor information

#### Basic Information

ID: The ID of transcription factor collected in PlantMADS Database.

UniProt ID: The ID in UniProt of the transcription factor.

Protein Name: The common name of the transcription factor in UniProt.

Protein Alias: Another possible name for the transcription factor.

Gene Name: The name of the full gene approved by HGNC.

Gene Alias: Another possible name for the gene.

Organism: The scientific name of the organism that the transcription factor belongs to.

Taxon ID: The taxonomic ID and lineage for each organism, collected from UniProt.

Lineage: The position of the organism in a continous line of descent from ancestor to descendant.

Description: A brief description of the function and mode of action of this transcription factor.

#### Protein Sequence

Information including Sequence Length, Molecular Weight and Sequence.

Click the link [Download FASTA] to download the protein sequence with fasta format.

#### Position of MADS-box According to HMMER

Displays the specific position of MADS-box genes According to HMMER, and provides information including Score, E-value, Alignment Start, Alignment End, HMM Start and HMM End.

#### Gene Ontology

The Gene Ontology (GO) is a major bioinformatics initiative to unify the representation of gene and gene product attributes across all species.

### Quick Search

The quick search box in the menu bar allows you to search the database by a keyword at any time. It will return the entries of the proteins whose name or description contains your keyword.

### Advanced Search

This section allows you to get certain entrys from our database by giving one or more conditions.You can specify the type of you conditions (e.g. protein name, organism, etc.), and their logical relationship (AND/OR). You may press the button "+" at the first line to add more conditions, and press the button "-" at any other line to delete the condition in this line.

### Browse

You can browse all the flowering transcription factors included in this database here, categorized by species.

In the browse page, click the organism you are searching for to view all of its MADS-BOX family transcription factors collected in this database. Then, click the protein name to view its detailed information.

### Basic Local Alignment Search Tool (BLAST)

#### Steps

Step 1: Enter a protein sequence (raw sequence or fasta format) into the form field.

Step 2: Click the Blast button.

#### Options

Program: Choose the blast programm. (blastp: This program, given a protein query, returns the most similar protein sequences. blastx: This program compares the six-frame conceptual translation products of a nucleotide query sequence (both strands) against the protein sequence database.)

Scoring Matrix: The matrix assigns a probability score for each position in an alignment. The BLOSUM matrix assigns a probability score for each position in an alignment that is based on the frequency with which that substitution is known to occur among consensus blocks within related proteins. BLOSUM62 is among the best of the available matrices for detecting weak protein similarities. The PAM set of matrices is also available. If "Auto" is set, the matrix will be selected depending on the query sequence length.

Expect threshold: The expectation value (E) threshold is a statistical measure of the number of expected matches in a random database. The lower the e-value, the more likely the match is to be significant. E-values between 0.1 and 10 are generally dubious, and over 10 are unlikely to have biological significance. In all cases, those matches need to be verified manually. You may need to increase the E threshold if you have a very short query sequence, to detect very weak similarities, or similarities in a short region.

#### Results

The BLAST result contains a table showing the ID, Protein Name, Organism, Score and E-value of proteins found in our database, and a pairwise list following it.

## About Us

### Developers

- Chen Yi-Han
- Zou Ji-Ping
- Zhu Jin-Yu
- Gao Pei-Xiang

### Data Source

The list of manually reviewed MADS-box proteins is obtained from InterPro, then basic information of these proteins is collected from Uniprot.

The position of MADS-box domain in each protein is located by HMMER, with a MADS-box domain profile obtained from Pfam.

### Disclaimer

This website is built merely for educational purpose currently. All rights reserved.
